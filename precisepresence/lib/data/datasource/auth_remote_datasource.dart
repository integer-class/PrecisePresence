import 'package:dartz/dartz.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import '../responses/auth_response_model.dart';
import '../../constants/variables.dart';

class AuthRemoteDatasource {
  Future<Either<String, AuthResponseModel>> login(
      String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/login'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'email': email, 'password': password}),
      );

      if (response.statusCode == 200) {
        return Right(AuthResponseModel.fromJson(json.decode(response.body)));
      } else if (response.statusCode == 401) {
        return Left('Invalid email or password');
      } else {
        return Left('An error occurred: ${response.body}');
      }
    } catch (e) {
      return Left('An error occurred: $e');
    }
  }
}
