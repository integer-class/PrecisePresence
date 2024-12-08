import 'dart:convert';
import 'dart:io';
import 'package:dartz/dartz.dart';
import 'package:http/http.dart' as http;
import 'package:geolocator/geolocator.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';

class LeaveRequestRemoteDatasource {
  Future<Either<String, String>> submitLeaveRequest({
    required String jenisIzin,
    required String tanggalMulai,
    required String tanggalSelesai,
    String? keterangan,
    File? dokumenPendukung,
  }) async {
    try {
      AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
      AuthResponseModel? authData = await authLocalDatasource.getAuthData();

      if (authData == null) {
        return Left('User data not found');
      }

      String idKaryawan = authData.idKaryawan ?? '1';
      String userToken = authData.userToken;

      final headers = {
        'Authorization': 'Bearer $userToken',
      };

      Position position = await _getCurrentLocation();
      double lon = position.longitude;
      double lat = position.latitude;

      final url = Uri.parse('https://your-laravel-api.com/api/user/perizinan');

      var request = http.MultipartRequest('POST', url);
      request.headers.addAll(headers);
      request.fields.addAll({
        'jenis_izin': jenisIzin,
        'tanggal_mulai': tanggalMulai,
        'tanggal_selesai': tanggalSelesai,
        'keterangan': keterangan ?? '',
        'lon': lon.toString(),
        'lat': lat.toString(),
      });

      // Menambahkan dokumen pendukung jika ada
      if (dokumenPendukung != null) {
        request.files.add(
          await http.MultipartFile.fromPath(
            'dokumen_pendukung',
            dokumenPendukung.path,
          ),
        );
      }

      // Mengirim request
      final response = await request.send();

      // Cek status response
      if (response.statusCode == 201) {
        final responseBody = await response.stream.bytesToString();
        return Right(responseBody); // Sukses
      } else if (response.statusCode == 422) {
        final responseBody = await response.stream.bytesToString();
        final Map<String, dynamic> errorData = json.decode(responseBody);
        return Left(errorData['message'] ?? 'Validation Error');
      } else {
        return Left('Failed to submit leave request: ${response.reasonPhrase}');
      }
    } catch (e) {
      return Left('Error occurred: $e');
    }
  }

  Future<Position> _getCurrentLocation() async {
    bool serviceEnabled;
    LocationPermission permission;

    serviceEnabled = await Geolocator.isLocationServiceEnabled();
    if (!serviceEnabled) {
      throw Exception('Location services are disabled.');
    }

    permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) {
        throw Exception('Location permissions are denied');
      }
    }

    if (permission == LocationPermission.deniedForever) {
      throw Exception(
        'Location permissions are permanently denied, we cannot request permissions.',
      );
    }

    return await Geolocator.getCurrentPosition(
      desiredAccuracy: LocationAccuracy.high,
    );
  }
}
