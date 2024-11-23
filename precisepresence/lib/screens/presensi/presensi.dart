import 'dart:io';
import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:precisepresence/data/datasource/checkin_remote_datasource.dart';

class Presensi extends StatefulWidget {
  const Presensi({super.key});

  @override
  State<Presensi> createState() => _PresensiState();
}

class _PresensiState extends State<Presensi> {
  late CameraController _cameraController;
  late List<CameraDescription> _cameras;
  bool _isCameraInitialized = false;
  String? _imagePath;
  bool _isUploading = false;

  @override
  void initState() {
    super.initState();
    _initializeCamera();
  }

  Future<void> _initializeCamera() async {
    _cameras = await availableCameras();

    // Mencari kamera depan
    final frontCamera = _cameras.firstWhere(
      (camera) => camera.lensDirection == CameraLensDirection.front,
      orElse: () => _cameras[0],
    );

    _cameraController = CameraController(
      frontCamera,
      ResolutionPreset.high,
    );

    await _cameraController.initialize();
    setState(() {
      _isCameraInitialized = true;
    });
  }

  @override
  void dispose() {
    _cameraController.dispose();
    super.dispose();
  }

  Future<void> _takePicture() async {
    try {
      final image = await _cameraController.takePicture();
      setState(() {
        _imagePath = image.path;
      });
      debugPrint("Foto diambil: ${image.path}");
    } catch (e) {
      debugPrint("Gagal mengambil gambar: $e");
    }
  }

  Future<void> _uploadPicture() async {
    if (_imagePath == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Ambil foto terlebih dahulu')),
      );
      return;
    }

    setState(() {
      _isUploading = true;
    });

    try {
      // Simulasi data untuk upload
      const idKaryawan = '1';
      const lon = 112.63402551123;
      const lat = -7.97713080123123;
      const userToken = 'kNaxDoJDAdmAvt6SojOJhNuwE46uuvMuiAIY0HU53d5cfde4';
      final foto = File(_imagePath!);

      // Instansiasi CheckInRemoteDatasource
      final datasource = CheckInRemoteDatasource();

      final result = await datasource.postCheckIn(
        foto: foto,
      );

      result.fold(
        (error) {
          // Menampilkan pesan error yang diterima dari server
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Gagal: $error')),
          );
        },
        (success) => ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Foto berhasil diunggah')),
        ),
      );
    } catch (e) {
      debugPrint('Error saat mengunggah: $e');
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Terjadi kesalahan saat mengunggah')),
      );
    } finally {
      setState(() {
        _isUploading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Presensi - Kamera Depan (Mirror)"),
        centerTitle: true,
      ),
      body: _isCameraInitialized
          ? Column(
              children: [
                Expanded(
                  child: Stack(
                    children: [
                      Transform(
                        alignment: Alignment.center,
                        transform: Matrix4.rotationY(3.14159),
                        child: CameraPreview(_cameraController),
                      ),
                      Positioned(
                        bottom: 20,
                        left: 0,
                        right: 0,
                        child: Center(
                          child: ElevatedButton(
                            onPressed: _takePicture,
                            style: ElevatedButton.styleFrom(
                              shape: const CircleBorder(),
                              padding: const EdgeInsets.all(15),
                            ),
                            child: const Icon(
                              Icons.camera_alt,
                              size: 30,
                            ),
                          ),
                        ),
                      )
                    ],
                  ),
                ),
                if (_imagePath != null)
                  Padding(
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      children: [
                        Image.file(
                          File(_imagePath!),
                          height: 200,
                          width: double.infinity,
                          fit: BoxFit.cover,
                        ),
                        const SizedBox(height: 10),
                        ElevatedButton.icon(
                          onPressed: _isUploading ? null : _uploadPicture,
                          icon: _isUploading
                              ? const CircularProgressIndicator(
                                  color: Colors.white)
                              : const Icon(Icons.upload),
                          label: const Text('Unggah Foto'),
                        ),
                      ],
                    ),
                  ),
              ],
            )
          : const Center(
              child: CircularProgressIndicator(),
            ),
    );
  }
}
