import 'package:dartz/dartz.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:precisepresence/router/app_router.dart';

class CustomFloatingActionButton extends StatelessWidget {
  final VoidCallback onPressed;

  const CustomFloatingActionButton({Key? key, required this.onPressed})
      : super(key: key);

  Future<void> checkAttendance(BuildContext context) async {
    AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
    AuthResponseModel? authData = await authLocalDatasource.getAuthData();

    if (authData == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('User data not found')),
      );
      return;
    }

    String idKaryawan = authData.idKaryawan ?? '1';
    String userToken = authData.userToken;

    final headers = {
      'Authorization': 'Bearer $userToken',
    };

    final url = Uri.parse(
        'http://20.211.46.189/api/user/cek_presensi?id_karyawan=$idKaryawan');

    try {
      final response = await http.get(url, headers: headers);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['message'] == 'sudah check-in, belum checkout') {
          context.go('/${RootTab.checkout.value}');
        } else if (data['message'] == 'belum check-in') {
          context.go('/${RootTab.presensi.value}');
        } else if (data['message'] == 'sudah checkout.') {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
                content: Text('Anda sudah absen masuk dan pulang hari ini')),
          );
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text('Unexpected response from server')),
          );
        }
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Failed to fetch data from server')),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return FloatingActionButton(
      onPressed: () =>
          checkAttendance(context), // Call checkAttendance when pressed
      child: const Icon(
        Icons.contacts_sharp,
        color: Colors.white,
      ),
      backgroundColor: AppColors.primary,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(20),
      ),
    );
  }
}
