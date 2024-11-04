import 'dart:convert';

class AuthResponseModel {
  final String? userToken;
  final String? tokenType;
  final String? accessToken;
  final bool? verified;
  final String? status;
  final User? user;

  AuthResponseModel({
    this.userToken,
    this.tokenType,
    this.verified,
    this.accessToken,
    this.status,
    this.user,
  });

  factory AuthResponseModel.fromJson(String str) =>
      AuthResponseModel.fromMap(json.decode(str));

  String toJson() => json.encode(toMap());

  factory AuthResponseModel.fromMap(Map<String, dynamic> json) =>
      AuthResponseModel(
        userToken: json["user_token"],
        tokenType: json["token_type"],
        verified: json["verified"],
        status: json["status"],
        user: json["email"] != null
            ? User.fromMap(json)
            : null, // Use User.fromMap if user details are included
      );

  Map<String, dynamic> toMap() => {
        "user_token": userToken,
        "token_type": tokenType,
        "verified": verified,
        "status": status,
        "email": user?.email, // Include user email from User if needed
      };
}

class User {
  final String? email;
  final String? role;

  User({
    this.email,
    this.role,
  });

  factory User.fromJson(String str) => User.fromMap(json.decode(str));

  String toJson() => json.encode(toMap());

  factory User.fromMap(Map<String, dynamic> json) => User(
        email: json["email"],
        role: json["role"],
      );

  Map<String, dynamic> toMap() => {
        "email": email,
        "role": role,
      };
}
