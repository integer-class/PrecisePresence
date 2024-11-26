import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  static const String baseUrl = "http://20.211.46.189/api/user";

  Future<Map<String, dynamic>> fetchAttendanceByDate(
      String date, String token) async {
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
        return jsonDecode(response.body);
      } else {
        throw Exception("Failed to load attendance");
      }
    } catch (e) {
      throw Exception("Error: $e");
    }
  }
}
