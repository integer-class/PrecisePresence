import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/datasource/auth_remote_datasource.dart';
import 'package:go_router/go_router.dart';
import '../../router/app_router.dart';
import '../../router/models/path_parameters.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final AuthRemoteDatasource _authRemoteDatasource = AuthRemoteDatasource();

  bool _isLoading = false;
  String? _errorMessage;

  Future<void> _login() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    final email = _emailController.text.trim();
    final password = _passwordController.text.trim();

    // Panggil fungsi login dari AuthRemoteDatasource
    final result = await _authRemoteDatasource.login(email, password);

    result.fold(
      (error) {
        // Jika login gagal, tampilkan pesan error
        setState(() {
          _isLoading = false;
          _errorMessage = error;
        });
      },
      (authResponse) {
        setState(() {
          _isLoading = false;
        });
        // Menyimpan data login (authResponse) ke local storage
        AuthLocalDatasource().saveAuthData(authResponse);

        // Navigasi ke halaman utama
        context.pushReplacementNamed(
          RouteConstants.root,
          pathParameters: PathParameters().toMap(),
        );
      },
    );
  }

  @override
  void dispose() {
    _emailController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              "Login",
              style: TextStyle(
                color: AppColors.black,
                fontSize: 30.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10.0),
            const Text(
              "Welcome back to PrecisePresence",
              style: TextStyle(
                color: AppColors.grey,
                fontSize: 18.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 30.0),
            const Text(
              'Email Address',
              style: TextStyle(
                color: AppColors.black,
                fontSize: 15.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10.0),
            TextField(
              controller: _emailController,
              decoration: const InputDecoration(
                border: OutlineInputBorder(),
                labelText: 'halo@precisepresence.com',
              ),
            ),
            const SizedBox(height: 20.0),
            const Text(
              'Password',
              style: TextStyle(
                color: AppColors.black,
                fontSize: 15.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10.0),
            TextField(
              controller: _passwordController,
              obscureText: true,
              decoration: const InputDecoration(
                border: OutlineInputBorder(),
                labelText: '...........',
              ),
            ),
            const SizedBox(height: 16.0),
            if (_errorMessage != null)
              Text(
                _errorMessage!,
                style: const TextStyle(color: AppColors.red),
              ),
            const SizedBox(height: 16.0),
            SizedBox(
              width: double.infinity,
              child: _isLoading
                  ? const Center(child: CircularProgressIndicator())
                  : ElevatedButton(
                      onPressed: _login,
                      style: ElevatedButton.styleFrom(
                        backgroundColor: AppColors.primary,
                        padding: const EdgeInsets.symmetric(vertical: 15.0),
                      ),
                      child: const Text(
                        'Login',
                        style: TextStyle(
                          fontSize: 16.0,
                          color: AppColors.white,
                        ),
                      ),
                    ),
            ),
          ],
        ),
      ),
    );
  }
}
