import 'dart:convert';

AuthResponseModel authResponseModelFromJson(String str) =>
    AuthResponseModel.fromJson(json.decode(str));

String authResponseModelToJson(AuthResponseModel data) =>
    json.encode(data.toJson());

class AuthResponseModel {
  String idKaryawan;
  String email;
  String role;
  String userToken;
  String tokenType;
  bool verified;
  String status;
  String name;
  String divisi;
  String alamat;
  DateTime ttl;
  String jenisKelamin;
  String noHp;
  String foto;

  AuthResponseModel({
    required this.idKaryawan, // Added id_karyawan to constructor
    required this.email,
    required this.role,
    required this.userToken,
    required this.tokenType,
    required this.verified,
    required this.status,
    required this.name,
    required this.divisi,
    required this.alamat,
    required this.ttl,
    required this.jenisKelamin,
    required this.noHp,
    required this.foto,
  });

  factory AuthResponseModel.fromJson(Map<String, dynamic> json) =>
      AuthResponseModel(
        idKaryawan: json["id_karyawan"], // Parsing id_karyawan
        email: json["email"],
        role: json["role"],
        userToken: json["user_token"],
        tokenType: json["token_type"],
        verified: json["verified"],
        status: json["status"],
        name: json["name"],
        divisi: json["divisi"],
        alamat: json["alamat"],
        ttl: DateTime.parse(json["ttl"]),
        jenisKelamin: json["jenis_kelamin"],
        noHp: json["no_hp"],
        foto: json["foto"],
      );

  Map<String, dynamic> toJson() => {
        "id_karyawan": idKaryawan, // Adding id_karyawan to toJson
        "email": email,
        "role": role,
        "user_token": userToken,
        "token_type": tokenType,
        "verified": verified,
        "status": status,
        "name": name,
        "divisi": divisi,
        "alamat": alamat,
        "ttl":
            "${ttl.year.toString().padLeft(4, '0')}-${ttl.month.toString().padLeft(2, '0')}-${ttl.day.toString().padLeft(2, '0')}",
        "jenis_kelamin": jenisKelamin,
        "no_hp": noHp,
        "foto": foto,
      };
}
