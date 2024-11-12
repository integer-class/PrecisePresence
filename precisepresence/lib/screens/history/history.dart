// history_page.dart
import 'package:flutter/material.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';

import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';

class HistoryPage extends StatelessWidget {
  const HistoryPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("History"),
      ),
      body: Center(
        child: const Text("History Page"),
      ),
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(currentTab: RootTab.history),
    );
  }
}
