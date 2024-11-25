import 'dart:convert';
import 'package:dartz/dartz.dart';
import 'package:http/http.dart' as http;
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/history_response_model.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';

class HistoryRemoteDatasource {
  Future<Either<String, HistoryResponseModel>> getHistory() async {
    // Load user data to get id_karyawan and token
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

    final url = Uri.parse('http://20.211.46.189/api/user/history');

    final response = await http.get(url, headers: headers);

    if (response.statusCode == 200) {
      // Parse the response body
      final Map<String, dynamic> data = json.decode(response.body);
      return Right(HistoryResponseModel.fromJson(data));
    } else {
      return Left('Failed to get history: ${response.body}');
    }
  }
}
