import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/datasource/auth_local_datasource.dart';
import 'package:precisepresence/data/responses/auth_response_model.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/screens/components/TodayAttandance.dart'; // Fixed class name typo
import 'package:precisepresence/screens/components/activity.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';
import 'package:precisepresence/screens/components/date.dart';

class Homepage extends StatefulWidget {
  final RootTab currentTab;

  const Homepage({
    Key? key,
    required this.currentTab,
  }) : super(key: key);

  @override
  State<Homepage> createState() => _HomepageState();
}

class _HomepageState extends State<Homepage> {
  String userName = 'User';
  String divisi = 'Divisi';
  String imageUrl = '';
  String selectedDate = DateFormat('yyyy-MM-dd')
      .format(DateTime.now()); // To hold the selected date

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
      });
    }
  }

  AppBar buildAppBar() {
    return AppBar(
      title: Row(
        children: [
          CircleAvatar(
            radius: 20,
            backgroundImage: imageUrl.isNotEmpty
                ? NetworkImage('$baseImg/$imageUrl')
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

  // Callback function to handle the date selection
  void onDateSelected(String selectedDate) {
    setState(() {
      this.selectedDate = selectedDate;
    });
    // You can use the selected date for other purposes, such as fetching data for that date
    print("Selected Date: $selectedDate");
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBody: true,
      appBar: buildAppBar(),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              DateComponent(
                  onDateSelected: onDateSelected), // Pass the callback here
              TodayAttendance(
                selectedDate: selectedDate,
              ),
              const Activity(),
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
}
