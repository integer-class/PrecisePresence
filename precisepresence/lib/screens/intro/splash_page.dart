import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/router/models/path_parameters.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart'; // Import untuk memeriksa status login

import '../../constants/colors.dart';

class SplashPage extends StatefulWidget {
  const SplashPage({super.key});

  @override
  State<SplashPage> createState() => _SplashPageState();
}

class _SplashPageState extends State<SplashPage> {
  @override
  void initState() {
    super.initState();
    _checkAuthStatus();
  }

  Future<void> _checkAuthStatus() async {
    // Cek status autentikasi pengguna
    final isAuth = await AuthLocalDatasource().isAuth();

    // Tunggu sebentar dan arahkan ke halaman yang tepat
    await Future.delayed(const Duration(seconds: 2));

    // Jika sudah login, arahkan ke halaman utama; jika belum login, arahkan ke halaman login
    if (!isAuth) {
      context.pushNamed(
        RouteConstants.login,
      );
    } else {
      context.goNamed(
        RouteConstants.root,
        pathParameters: PathParameters(
          rootTab: RootTab.home,
        ).toMap(),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      body: Center(
        child: Text(
          'PrecisePresence',
          style: TextStyle(
            color: AppColors.primary,
            fontWeight: FontWeight.w900,
            fontSize: 24,
          ),
          textAlign: TextAlign.center,
        ),
      ),
    );
  }
}
