import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/screens/components/TodayAttandance.dart';
import 'package:precisepresence/screens/components/activity.dart';
import 'package:precisepresence/screens/components/date.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart'; // Import the new file
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
      extendBody: true,
      appBar: buildAppBar(),
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
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(),
    );
  }

  AppBar buildAppBar() {
    return AppBar(
      title: Row(
        children: [
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
          const Spacer(),
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.notifications_none),
          ),
        ],
      ),
      centerTitle: false,
    );
  }
}

class CustomBottomAppBar extends StatelessWidget {
  const CustomBottomAppBar({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      padding: const EdgeInsets.symmetric(horizontal: 10),
      height: 60,
      color: Colors.blue[100], // Warna latar belakang biru muda
      shape: const CircularNotchedRectangle(),
      notchMargin: 8,
      child: Row(
        mainAxisSize: MainAxisSize.max,
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: <Widget>[
          IconButton(
            icon: const Icon(
              Icons.menu,
              color: AppColors.primary,
            ),
            onPressed: () {},
          ),
          IconButton(
            icon: const Icon(
              Icons.search,
              color: AppColors.primary,
            ),
            onPressed: () {},
          ),
          IconButton(
            icon: const Icon(
              Icons.print,
              color: AppColors.primary,
            ),
            onPressed: () {},
          ),
          IconButton(
            icon: const Icon(
              Icons.people,
              color: AppColors.primary,
            ),
            onPressed: () {},
          ),
        ],
      ),
    );
  }
}
