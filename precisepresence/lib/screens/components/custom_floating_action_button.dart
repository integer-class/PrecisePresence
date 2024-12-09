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
        'https://precisepresence.me/api/user/cek_presensi?id_karyawan=$idKaryawan');

    try {
      final response = await http.get(url, headers: headers);

      print('response: ${response.body}'); // Debug respons server

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['require_confirmation'] == true) {
          // Tampilkan dialog konfirmasi
          bool? confirm = await showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text('Konfirmasi'),
                content: Text(data['message'] ?? 'Anda memiliki izin aktif.'),
                actions: [
                  TextButton(
                    onPressed: () {
                      Navigator.pop(context, false); // Batalkan
                    },
                    child: const Text('Batal'),
                  ),
                  TextButton(
                    onPressed: () {
                      Navigator.pop(context, true); // Lanjutkan
                    },
                    child: const Text('Lanjutkan'),
                  ),
                ],
              );
            },
          );

          if (confirm == true) {
            // Kirim GET request untuk check-in paksa
            final forceCheckInUrl = Uri.parse(
                'https://precisepresence.me/api/user/cek_presensi?id_karyawan=$idKaryawan&force_checkin=true');
            final forceCheckInResponse =
                await http.get(forceCheckInUrl, headers: headers);

            if (forceCheckInResponse.statusCode == 200) {
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Check-in berhasil')),
              );
              context.go('/${RootTab.presensi.value}');
            } else {
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Gagal melakukan check-in')),
              );
            }
          }
        } else if (data['message'] == 'success') {
          context.go('/${RootTab.presensi.value}');
        } else if (data['message'] == 'no data found') {
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
        // Tangani kegagalan dengan status selain 200
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
              content: Text(
                  'Failed to fetch data from server: ${response.statusCode}')),
        );
      }
    } catch (e) {
      // Tangani error jaringan atau parsing
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
