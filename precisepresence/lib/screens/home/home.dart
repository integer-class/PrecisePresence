import 'package:flutter/material.dart';

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
    return const Placeholder();
  }
}
