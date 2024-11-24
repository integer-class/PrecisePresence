import 'dart:io';
import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/data/datasource/checkin_remote_datasource.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/router/models/path_parameters.dart';

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

      // Langsung unggah foto setelah diambil
      await _uploadPicture();
    } catch (e) {
      debugPrint("Gagal mengambil gambar: $e");
    }
  }

  Future<void> _uploadPicture() async {
    if (_imagePath == null) return;

    setState(() {
      _isUploading = true;
    });

    try {
      final foto = File(_imagePath!);
      final datasource = CheckInRemoteDatasource();

      final result = await datasource.postCheckIn(
        foto: foto,
      );

      result.fold(
        (error) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Gagal: $error')),
          );
        },
        (success) {
          showDialog(
            context: context,
            barrierDismissible: false,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text('Berhasil'),
                content: const Text('Berhasil Absen Masuk'),
                actions: [
                  TextButton(
                    onPressed: () {
                      Navigator.pop(context);
                      context.goNamed(
                        RouteConstants.root,
                        pathParameters: PathParameters(
                          rootTab: RootTab.home,
                        ).toMap(),
                      );
                    },
                    child: const Text('OK'),
                  ),
                ],
              );
            },
          );
        },
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
        title: const Text("Presensi Kedatangan"),
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            context.goNamed(
              RouteConstants.root,
              pathParameters: PathParameters(
                rootTab: RootTab.home,
              ).toMap(),
            );
          },
        ),
      ),
      body: _isCameraInitialized
          ? Stack(
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
                      onPressed: _isUploading ? null : _takePicture,
                      style: ElevatedButton.styleFrom(
                        shape: const CircleBorder(),
                        padding: const EdgeInsets.all(15),
                      ),
                      child: _isUploading
                          ? const CircularProgressIndicator(color: Colors.white)
                          : const Icon(
                              Icons.camera_alt,
                              size: 30,
                            ),
                    ),
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
