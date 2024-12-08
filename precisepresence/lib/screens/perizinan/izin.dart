import 'package:dotted_border/dotted_border.dart';
import 'package:file_picker/file_picker.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';
import 'package:precisepresence/screens/perizinan/history.dart';
import 'package:precisepresence/screens/perizinan/reuqest.dart';

class LeavesPage extends StatefulWidget {
  const LeavesPage({super.key});

  @override
  State<LeavesPage> createState() => _LeavesPageState();
}

class _LeavesPageState extends State<LeavesPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          "My Leaves",
          style: TextStyle(
            color: Color.fromRGBO(12, 57, 120, 1),
            fontSize: 16,
            fontWeight: FontWeight.w700,
          ),
        ),
        iconTheme: const IconThemeData(
          color: Color.fromRGBO(12, 57, 120, 1),
        ),
        backgroundColor: const Color.fromRGBO(208, 228, 255, 1),
        elevation: 0.0,
        surfaceTintColor: Colors.transparent,
      ),
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 28, vertical: 8),
            child: RequestLeavePage(),
          ),
          Expanded(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 28),
              child: HistoryPerizinan(),
            ),
          ),
        ],
      ),
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(currentTab: RootTab.perizinan),
    );
  }
}
