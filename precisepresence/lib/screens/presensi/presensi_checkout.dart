import 'dart:io';
import 'dart:math';
import 'dart:typed_data';
import 'package:image/image.dart' as img;
import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/data/datasource/CheckOutRemoteDatasource.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/router/models/path_parameters.dart';

class Checkout extends StatefulWidget {
  const Checkout({super.key});

  @override
  State<Checkout> createState() => _CheckoutState();
}

class _CheckoutState extends State<Checkout> {
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

    // Memilih kamera depan
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
      final file = File(_imagePath!);
      final bytes = await file.readAsBytes();

      // Menggunakan package image untuk membaca gambar
      img.Image? image = img.decodeImage(Uint8List.fromList(bytes));

      if (image != null) {
        const maxWidth = 2000;
        const maxHeight = 2000;

        if (image.width > maxWidth || image.height > maxHeight) {
          image = img.copyResize(image, width: maxWidth, height: maxHeight);
        }

        // Membuat nama file acak
        final randomFileName = '${_generateRandomString(10)}.jpg';
        final resizedFile = File('${file.parent.path}/$randomFileName')
          ..writeAsBytesSync(img.encodeJpg(image));

        // Upload gambar yang sudah di-resize
        final datasource = CheckOutRemoteDatasource();
        final result = await datasource.postCheckOut(foto: resizedFile);

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
                  content: const Text('Berhasil Checkout'),
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
      } else {
        throw Exception("Gagal mendecode gambar");
      }
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

  // Fungsi untuk menghasilkan string acak (misalnya untuk nama file)
  String _generateRandomString(int length) {
    const chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    Random rnd = Random();
    return List.generate(length, (index) => chars[rnd.nextInt(chars.length)])
        .join();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Absen Pulang"),
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
                CameraPreview(_cameraController),
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
