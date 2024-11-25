import 'package:flutter/material.dart';
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

    final email = _emailController.text;
    final password = _passwordController.text;

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
      appBar: AppBar(
        title: const Text('Login'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            TextField(
              controller: _emailController,
              decoration: const InputDecoration(labelText: 'Email'),
            ),
            const SizedBox(height: 16),
            TextField(
              controller: _passwordController,
              obscureText: true,
              decoration: const InputDecoration(labelText: 'Password'),
            ),
            const SizedBox(height: 24),
            if (_errorMessage != null)
              Text(
                _errorMessage!,
                style: const TextStyle(color: Colors.red),
              ),
            const SizedBox(height: 16),
            _isLoading
                ? const CircularProgressIndicator()
                : ElevatedButton(
                    onPressed: _login,
                    child: const Text('Login'),
                  ),
          ],
        ),
      ),
    );
  }
}
