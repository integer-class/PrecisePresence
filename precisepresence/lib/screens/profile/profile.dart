import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:intl/intl.dart';

class Profile extends StatefulWidget {
  const Profile({super.key});

  @override
  State<Profile> createState() => _ProfileState();
}

class _ProfileState extends State<Profile> {
  String userName = '';
  String divisi = '';
  String imageUrl = '';
  String email = '';
  String alamat = '';
  DateTime ttl = DateTime.now();
  String jenisKelamin = '';
  String noHp = '';
  String role = '';

  @override
  void initState() {
    super.initState();
    _loadUserData();
  }

  Future<void> _loadUserData() async {
    AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
    AuthResponseModel? authData = await authLocalDatasource.getAuthData();
    if (authData != null) {
      setState(() {
        userName = authData.name ?? 'User';
        divisi = authData.divisi ?? 'Divisi';
        imageUrl = authData.foto ?? '';
        email = authData.email ?? '';
        alamat = authData.alamat ?? '';
        ttl = authData.ttl ?? DateTime.now();
        jenisKelamin = authData.jenisKelamin ?? '';
        noHp = authData.noHp ?? '';
        role = authData.role ?? '';
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Profile'),
        actions: [
          IconButton(
            onPressed: () async {
              final authDatasource = AuthLocalDatasource();
              await authDatasource.removeAuthData();
              context.goNamed(RouteConstants.login);
            },
            icon: const Icon(Icons.exit_to_app, color: Colors.red),
          ),
        ],
        backgroundColor: Colors.blue[100],
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              ClipPath(
                clipper: ProfileHeaderClipper(),
                child: Container(
                  height: 300,
                  color: Colors.blue[100],
                  child: Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Container(
                          width: 120,
                          height: 120,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            image: DecorationImage(
                              image: NetworkImage('$baseImg/$imageUrl'),
                              fit: BoxFit.cover,
                            ),
                          ),
                        ),
                        SizedBox(height: 10),
                        Text(
                          userName,
                          style: TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: AppColors.primary,
                          ),
                        ),
                        Text(
                          divisi,
                          style: TextStyle(
                            fontSize: 15,
                            color: const Color.fromARGB(255, 14, 50, 100),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              Container(
                padding: EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    infoRow(Icons.person_2_outlined, 'Name', userName),
                    infoRow(Icons.badge_outlined, 'Role', 'karyawan'),
                    infoRow(Icons.email_outlined, 'Email', email),
                    infoRow(
                      Icons.cake_outlined,
                      'Date of birth',
                      DateFormat('dd MMMM yyyy').format(ttl),
                    ),
                    infoRow(Icons.phone_outlined, 'Phone Number', noHp),
                    infoRow(
                      Icons.location_on_outlined,
                      'Address',
                      alamat,
                      isExpandable: true,
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
      floatingActionButton: CustomFloatingActionButton(onPressed: () {}),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(currentTab: RootTab.profile),
    );
  }

  Widget infoRow(IconData icon, String label, String value,
      {bool isExpandable = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icon, size: 20),
          SizedBox(width: 10),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: TextStyle(fontSize: 15, fontWeight: FontWeight.bold),
                ),
                Text(
                  value,
                  style: TextStyle(fontSize: 20, color: AppColors.primary),
                  overflow: isExpandable ? TextOverflow.ellipsis : null,
                  maxLines: isExpandable ? 1 : null,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

// Custom Clipper for the curved header
class ProfileHeaderClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    final path = Path();
    path.lineTo(0, size.height - 50); // Start from bottom left
    path.quadraticBezierTo(
        size.width / 2, size.height, size.width, size.height - 50); // Curve
    path.lineTo(size.width, 0); // Top right
    path.close(); // Close the path
    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}
