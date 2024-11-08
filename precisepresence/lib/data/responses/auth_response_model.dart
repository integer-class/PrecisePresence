// To parse this JSON data, do
//
//     final authResponseModel = authResponseModelFromJson(jsonString);

import 'dart:convert';

AuthResponseModel authResponseModelFromJson(String str) =>
    AuthResponseModel.fromJson(json.decode(str));

String authResponseModelToJson(AuthResponseModel data) =>
    json.encode(data.toJson());

class AuthResponseModel {
  String email;
  String role;
  String userToken;
  String tokenType;
  bool verified;
  String status;

  AuthResponseModel({
    required this.email,
    required this.role,
    required this.userToken,
    required this.tokenType,
    required this.verified,
    required this.status,
  });

  factory AuthResponseModel.fromJson(Map<String, dynamic> json) =>
      AuthResponseModel(
        email: json["email"],
        role: json["role"],
        userToken: json["user_token"],
        tokenType: json["token_type"],
        verified: json["verified"],
        status: json["status"],
      );

  Map<String, dynamic> toJson() => {
        "email": email,
        "role": role,
        "user_token": userToken,
        "token_type": tokenType,
        "verified": verified,
        "status": status,
      };
}
