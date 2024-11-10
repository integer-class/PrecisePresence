import 'dart:convert';

import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:shared_preferences/shared_preferences.dart'; // Import untuk json.encode

class AuthLocalDatasource {
  Future<void> saveAuthData(AuthResponseModel authResponseModel) async {
    // Convert the Map<String, dynamic> to a JSON String
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('auth_data', json.encode(authResponseModel.toJson()));
  }

  Future<void> removeAuthData() async {
    //remove auth data from local storage
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_data');
  }

  Future<AuthResponseModel?> getAuthData() async {
    //get auth data from local storage
    final prefs = await SharedPreferences.getInstance();
    final authData = prefs.getString('auth_data');
    if (authData != null) {
      // Convert the JSON String back to Map and then to the AuthResponseModel object
      return AuthResponseModel.fromJson(json.decode(authData));
    } else {
      return null;
    }
  }

  Future<bool> isAuth() async {
    //check if user is authenticated
    final prefs = await SharedPreferences.getInstance();
    final authData = prefs.getString('auth_data');
    if (authData != null) {
      return true;
    } else {
      return false;
    }
  }
}
