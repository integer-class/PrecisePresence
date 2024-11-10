import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/screens/components/TodayAttandance.dart';
import 'package:precisepresence/screens/components/activity.dart';
import 'package:precisepresence/screens/components/date.dart';

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
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Row(
          children: [
            //image rouded
            const CircleAvatar(
              radius: 20,
              backgroundImage: AssetImage('assets/images/logo.png'),
            ),
            const SizedBox(width: 10),

            const Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text('Shofwah Kanaka', style: TextStyle(fontSize: 15)),
                Text('lead UI/UX Designer', style: TextStyle(fontSize: 12)),
              ],
            ),

            //icon button notification round
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
            children: [
              const DateComponent(),
              const TodayAttandance(),
              const Activity(),
            ],
          ),
        ),
      ),
    );
  }
}
