// custom_bottom_app_bar.dart
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/router/app_router.dart';

class CustomBottomAppBar extends StatelessWidget {
  final RootTab currentTab;

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
