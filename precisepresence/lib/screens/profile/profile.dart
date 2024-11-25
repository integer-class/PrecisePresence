import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';
import 'package:google_fonts/google_fonts.dart';
import '../../constants/colors.dart';

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
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        //button back
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.of(context).pop();
          },
        ),
        title: const Text('Profile'),

        //button exit
        actions: [
          IconButton(
            onPressed: () {
              // AppRouter().pushAndPopUntil(context, AppRouter().login);
            },
            icon: const Icon(Icons.exit_to_app, color: Colors.red),
          ),
        ],
        backgroundColor: Colors.blue[100], // Change the color here
      ),
      body: SafeArea(
          child: SingleChildScrollView(
        child: Container(
          // alignment: Alignment.centerLeft, // Mengatur alignment utama ke kiri
          child: Column(
            crossAxisAlignment:
                CrossAxisAlignment.start, // Elemen-elemen Column diset ke kiri
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
                        Text('Shofwah Kanaka',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                              color: AppColors.primary,
                            )),
                        Text('Lead UI/UX Designer',
                            style: TextStyle(
                              fontSize: 15,
                              color: const Color.fromARGB(255, 14, 50, 100),
                            )),
                      ],
                    ),
                  ),
                ),
              ),
              Container(
                padding:
                    EdgeInsets.only(left: 40, right: 20, top: 0, bottom: 20),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Name', style: TextStyle(fontSize: 15)),
                    //icon person
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.person_2_outlined, size: 20),
                          SizedBox(width: 10),
                          Text(
                            userName,
                            style: TextStyle(
                              fontSize: 20,
                              color: AppColors.primary,
                            ),
                          ),
                        ],
                      ),
                    ),

                    SizedBox(height: 15),
                    Text('Role', style: TextStyle(fontSize: 15)),
                    //icon
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.badge_outlined, size: 20),
                          SizedBox(width: 10),
                          Text(divisi,
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ],
                      ),
                    ),

                    SizedBox(height: 15),
                    Text('Email', style: TextStyle(fontSize: 15)),
                    //icon
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.email_outlined, size: 20),
                          SizedBox(width: 10),
                          Text('shofwah@gmail.com',
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ],
                      ),
                    ),

                    SizedBox(height: 15),
                    Text('Date of birth', style: TextStyle(fontSize: 15)),
                    //icon
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.cake_outlined, size: 20),
                          SizedBox(width: 10),
                          Text('20 Oktober 2000',
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ],
                      ),
                    ),

                    SizedBox(height: 15),
                    Text('Phone Number', style: TextStyle(fontSize: 15)),
                    //icon
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.phone_outlined, size: 20),
                          SizedBox(width: 10),
                          Text('08123456789',
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ],
                      ),
                    ),

                    SizedBox(height: 15),
                    Text('Address', style: TextStyle(fontSize: 15)),
                    //icon
                    Container(
                      padding: EdgeInsets.only(left: 10),
                      child: Row(
                        children: [
                          Icon(Icons.location_on_outlined, size: 20),
                          SizedBox(width: 10),
                          Text('Jl. Kaliurang KM 5, Yogyakarta',
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ],
                      ),
                    ),

                    SizedBox(height: 25),

                    Container(
                        height: 40,
                        width: double.infinity,
                        decoration: BoxDecoration(
                          //outline
                          border: Border.all(color: AppColors.primary),
                          borderRadius: BorderRadius.circular(50.0),
                        ),
                        child: Center(
                          child: Text('Edit Profile',
                              style: TextStyle(
                                fontSize: 20,
                                color: AppColors.primary,
                              )),
                        ))
                  ],
                ),
              ),
            ],
          ),
        ),
      )),
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(currentTab: RootTab.profile),
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
