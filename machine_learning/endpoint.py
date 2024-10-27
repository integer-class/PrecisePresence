from fastapi import FastAPI, UploadFile, File, HTTPException
from facenet_pytorch import MTCNN, InceptionResnetV1
from PIL import Image
import json
import mysql.connector
import torch
from typing import List

app = FastAPI()

# Initialize models
mtcnn = MTCNN(image_size=240, margin=0, min_face_size=20)
resnet = InceptionResnetV1(pretrained='vggface2').eval()


# Function to connect to the database
def get_db_connection():
    connection = mysql.connector.connect(
        host="phpmyadmin.test",  
        user="root",
        password="",
        database="dev"
    )
    return connection


# Endpoint for generating and saving embeddings
@app.post("/register_face/")
async def register_face(user_id: int, files: List[UploadFile] = File(...)):
    # Validate user_id
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT COUNT(*) FROM karyawan WHERE id_karyawan = %s", (user_id,))
    user_exists = cursor.fetchone()[0] > 0
    cursor.close()
    connection.close()

    if not user_exists:
        raise HTTPException(status_code=404, detail="User not found.")

    responses = []

    for file in files:
        # Open the uploaded image
        try:
            img = Image.open(file.file).convert('RGB')
        except Exception as e:
            raise HTTPException(status_code=400, detail=f"Error opening image: {str(e)}")

        # Detect face and get the embedding
        face, prob = mtcnn(img, return_prob=True)
        if face is None or prob < 0.90:
            responses.append({"filename": file.filename, "message": "No face detected with sufficient confidence."})
            continue  # Skip this file and move to the next

        # Generate embedding
        emb = resnet(face.unsqueeze(0)).detach().numpy().tolist()

        # Save embedding to database
        try:
            connection = get_db_connection()
            cursor = connection.cursor()
            embedding_json = json.dumps(emb)
            image_name = file.filename
            cursor.execute(
                "INSERT INTO karyawan_embeddings (id_karyawan, embedding, image_name) VALUES (%s, %s, %s)",
                (user_id, embedding_json, image_name)
            )
            connection.commit()
            responses.append({"filename": image_name, "message": "Embedding saved successfully"})
        except mysql.connector.Error as e:
            raise HTTPException(status_code=500, detail=f"Database error: {str(e)}")
        finally:
            cursor.close()
            connection.close()

    return {"responses": responses}


@app.post("/face_match/")
async def face_match(file: UploadFile = File(...), threshold: float = 0.7):
    # Open the uploaded image
    img = Image.open(file.file).convert('RGB')

    # Detect face and get the embedding
    face, prob = mtcnn(img, return_prob=True)
    if face is None or prob < 0.90:
        return {"message": "No face detected with sufficient confidence."}

    emb = resnet(face.unsqueeze(0)).detach()

    # Fetch all embeddings from the database
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True)

    cursor.execute("SELECT id_karyawan , embedding, image_name FROM karyawan_embeddings")
    embeddings_data = cursor.fetchall()

    cursor.close()
    connection.close()

    # Compare the new embedding with the stored embeddings
    dist_list = []
    for data in embeddings_data:
        embedding_db = torch.tensor(json.loads(data['embedding']))
        dist = torch.dist(emb, embedding_db).item()
        dist_list.append((dist, data['id_karyawan'], data['image_name']))  

    # Get the minimum distance and the corresponding user_id and image_name
    min_dist, id_karyawan, image_name = min(dist_list, key=lambda x: x[0])

    if min_dist > threshold:
        return {"message": "No match found", "distance": min_dist}
    else:
        return {"message": f"Face matched with user ID: {id_karyawan} (from image: {image_name})", "distance": min_dist}
