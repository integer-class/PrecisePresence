import 'dart:convert';
import 'dart:io';
import 'package:dartz/dartz.dart';
import 'package:geolocator/geolocator.dart';
import 'package:http/http.dart' as http;
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';

class CheckOutRemoteDatasource {
  Future<Either<String, String>> postCheckOut({
    required File foto,
  }) async {
    try {
      AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
      AuthResponseModel? authData = await authLocalDatasource.getAuthData();

      if (authData == null) {
        return Left('User data not found');
      }

      String idKaryawan = authData.idKaryawan ?? '1';
      String userToken = authData.userToken;

      Position position = await _getCurrentLocation();
      double lon = position.longitude;
      double lat = position.latitude;

      final url = Uri.parse('https://precisepresence.me/api/user/check-out');

      var request = http.MultipartRequest('POST', url);

      request.fields.addAll({
        'id_karyawan': idKaryawan,
        'lon': lon.toString(),
        'lat': lat.toString(),
      });

      request.files.add(
        await http.MultipartFile.fromPath('foto', foto.path),
      );

      request.headers.addAll({
        'Authorization': 'Bearer $userToken',
      });

      final response = await request.send();

      if (response.statusCode == 200) {
        final responseBody = await response.stream.bytesToString();
        return Right(responseBody); // Success
      } else if (response.statusCode == 400) {
        final responseBody = await response.stream.bytesToString();
        final Map<String, dynamic> errorData = json.decode(responseBody);
        return Left(errorData['message'] ?? 'Bad Request');
      } else {
        return Left('Failed to check-out: ${response.reasonPhrase}');
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
