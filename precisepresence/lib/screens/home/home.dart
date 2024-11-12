import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/TodayAttandance.dart';
import 'package:precisepresence/screens/components/activity.dart';
import 'package:precisepresence/screens/components/date.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart'; // Import the new file
import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:precisepresence/screens/home/home.dart';

class Homepage extends StatefulWidget {
  final RootTab currentTab; // Updated to RootTab enum
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
      bottomNavigationBar: CustomBottomAppBar(currentTab: widget.currentTab),
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
  final RootTab currentTab; // Accept the RootTab enum
  const CustomBottomAppBar({
    Key? key,
    required this.currentTab,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      padding: const EdgeInsets.symmetric(horizontal: 10),
      height: 60,
      color: Colors.blue[100],
      shape: const CircularNotchedRectangle(),
      notchMargin: 8,
      child: Row(
        mainAxisSize: MainAxisSize.max,
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: <Widget>[
          IconButton(
            icon: Icon(
              Icons.home,
              color:
                  currentTab == RootTab.home ? AppColors.primary : Colors.grey,
            ),
            onPressed: () {
              context.go('/${RootTab.home.value}');
            },
          ),
          IconButton(
            icon: Icon(
              Icons.history,
              color: currentTab == RootTab.history
                  ? AppColors.primary
                  : Colors.grey,
            ),
            onPressed: () {
              context.go('/${RootTab.history.value}');
            },
          ),
          IconButton(
            icon: Icon(
              Icons.print,
              color: currentTab == RootTab.perizinan
                  ? AppColors.primary
                  : Colors.grey,
            ),
            onPressed: () {
              context.go('/${RootTab.perizinan.value}');
            },
          ),
          IconButton(
            icon: Icon(
              Icons.account_circle,
              color: currentTab == RootTab.profil
                  ? AppColors.primary
                  : Colors.grey,
            ),
            onPressed: () {
              context.go('/${RootTab.profil.value}');
            },
          ),
        ],
      ),
    );
  }
}
