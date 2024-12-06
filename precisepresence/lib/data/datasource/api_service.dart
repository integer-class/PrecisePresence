import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/history_response_model.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';

class ApiService {
  static const String baseUrl = "https://precisepresence.me/api/user";

  Future<Map<String, dynamic>> fetchAttendanceByDate(String date) async {
    // Load user data to get id_karyawan and token
    AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
    AuthResponseModel? authData = await authLocalDatasource.getAuthData();

    if (authData == null) {
      throw Exception("Auth data is null");
    }
    String token = authData.userToken;

    final url = Uri.parse("$baseUrl/cek_perhari");
    try {
      final response = await http.post(
        url,
        headers: {
          "Authorization": "Bearer $token",
          "Content-Type": "application/json",
        },
        body: jsonEncode({"date": date}),
      );
      if (response.statusCode == 200) {
        // print(response.body);
        return jsonDecode(response.body);
      } else {
        throw Exception("Failed to load attendance");
      }
    } catch (e) {
      throw Exception("Error: $e");
    }
  }
}
