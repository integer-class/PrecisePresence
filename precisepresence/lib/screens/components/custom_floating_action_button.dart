import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/router/app_router.dart';

class CustomFloatingActionButton extends StatelessWidget {
  final VoidCallback onPressed;

  const CustomFloatingActionButton({Key? key, required this.onPressed})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return FloatingActionButton(
      onPressed: () {
        context.go('/${RootTab.presensi.value}');
      },
      child: const Icon(
        Icons.contacts_sharp,
        color: Colors.white, // Warna icon FAB
      ),
      backgroundColor: AppColors.primary, // Warna latar belakang FAB
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(20), // Membuat FAB lebih rounded
      ),
    );
  }
}
