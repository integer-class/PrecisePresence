import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/screens/components/TodayAttandance.dart';
import 'package:precisepresence/screens/components/activity.dart';
import 'package:precisepresence/screens/components/date.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';

class Homepage extends StatefulWidget {
  final int currentTab;
  const Homepage({
    Key? key,
    required this.currentTab,
  }) : super(key: key);

  @override
  State<Homepage> createState() => _HomepageState();
}

class _HomepageState extends State<Homepage> {
  String userName = 'User'; // Default name
  String divisi = 'Divisi'; // Default divisi
  String imageUrl = ''; // Default image

  @override
  void initState() {
    super.initState();
    _loadUserData();
  }

  Future<void> _loadUserData() async {
    AuthLocalDatasource authLocalDatasource = AuthLocalDatasource();
    AuthResponseModel? authData = await authLocalDatasource.getAuthData();
    if (authData != null) {
      print(
          "Name: ${authData.name}, Divisi: ${authData.divisi}"); // Debugging log
      setState(() {
        userName = authData.name ?? 'User';
        divisi = authData.divisi ?? 'Divisi';
        imageUrl = authData.foto ?? '';
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Row(
          children: [
            // Image rounded with fallback if imageUrl is empty
            CircleAvatar(
              radius: 20,
              backgroundImage: imageUrl.isNotEmpty
                  ? NetworkImage('$baseImg$imageUrl')
                  : const AssetImage('assets/images/default_profile.png')
                      as ImageProvider,
            ),
            const SizedBox(width: 10),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(userName, style: const TextStyle(fontSize: 15)),
                Text(divisi, style: const TextStyle(fontSize: 12)),
              ],
            ),
            // Icon button notification round
            const Spacer(),
            IconButton(
              onPressed: () {},
              icon: const Icon(Icons.notifications_none),
            ),
          ],
        ),
        centerTitle: false,
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: const [
              DateComponent(),
              TodayAttandance(),
              Activity(),
            ],
          ),
        ),
      ),
    );
  }
}
