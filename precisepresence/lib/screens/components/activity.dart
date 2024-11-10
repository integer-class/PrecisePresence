import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';

class Activity extends StatefulWidget {
  const Activity({super.key});

  @override
  State<Activity> createState() => _ActivityState();
}

class _ActivityState extends State<Activity> {
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(20.0),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: const [
              Text(
                "Your activity",
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 15.0,
                  fontWeight: FontWeight.bold,
                ),
              ),
              Text(
                "View All",
                style: TextStyle(
                  color: AppColors.primary,
                  fontSize: 14.0,
                ),
              ),
            ],
          ),
          const SizedBox(height: 10),
          Container(
            padding: const EdgeInsets.all(20.0),
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(10.0),
            ),
            child: Column(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Text(
                      "04 Oct, 2024",
                      style: TextStyle(
                        color: AppColors.primary,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  children: [
                    Text(
                      "Successfully Took Attendance",
                      style: TextStyle(
                        color: Color(0xFFED7D2B),
                        //bold
                        fontWeight: FontWeight.bold,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: const [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-in : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00.00",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-out : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00:00 PM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                  ],
                )
              ],
            ),
          ),
          const SizedBox(height: 10),
          Container(
            padding: const EdgeInsets.all(20.0),
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(10.0),
            ),
            child: Column(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Text(
                      "04 Oct, 2024",
                      style: TextStyle(
                        color: AppColors.primary,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  children: [
                    Text(
                      "Successfully Took Attendance",
                      style: TextStyle(
                        color: Color(0xFFED7D2B),
                        //bold
                        fontWeight: FontWeight.bold,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: const [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-in : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00.00",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-out : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00:00 PM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                  ],
                )
              ],
            ),
          ),
          SizedBox(height: 10),
          Container(
            padding: const EdgeInsets.all(20.0),
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(10.0),
            ),
            child: Column(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Text(
                      "04 Oct, 2024",
                      style: TextStyle(
                        color: AppColors.primary,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  children: [
                    Text(
                      "Successfully Took Attendance",
                      style: TextStyle(
                        color: Color(0xFFED7D2B),
                        //bold
                        fontWeight: FontWeight.bold,
                        fontSize: 16.0,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 10),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: const [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-in : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00.00",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          "check-out : 08:00 AM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                        Text(
                          "Late : 00:00 PM",
                          style: TextStyle(
                            color: Colors.black,
                            fontSize: 13.0,
                          ),
                        ),
                      ],
                    ),
                  ],
                )
              ],
            ),
          ),
        ],
      ),
    );
  }
}
