import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:precisepresence/constants/colors.dart';

class DateComponent extends StatelessWidget {
  const DateComponent({Key? key}) : super(key: key);

  List<Map<String, String>> generateLastSixDays() {
    List<Map<String, String>> days = [];
    DateTime today = DateTime.now();
    DateFormat dayFormat = DateFormat('EEE');
    DateFormat dateFormat = DateFormat('dd');

    for (int i = 5; i >= 0; i--) {
      // Loop mundur untuk 6 hari kebelakang
      DateTime currentDate = today.subtract(Duration(days: i));
      String day = dayFormat.format(currentDate);
      String date = dateFormat.format(currentDate);

      days.add({'day': day, 'date': date});
    }
    return days;
  }

  @override
  Widget build(BuildContext context) {
    List<Map<String, String>> pastDays = generateLastSixDays();

    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: Row(
          children: [
            for (var i = 0; i < pastDays.length; i++) ...[
              Column(
                children: [
                  Container(
                    padding: const EdgeInsets.symmetric(
                        vertical: 10.0, horizontal: 20.0),
                    decoration: BoxDecoration(
                      color: i == pastDays.length - 1
                          ? AppColors.primary
                          : Colors.white,
                      borderRadius: BorderRadius.circular(10.0),
                    ),
                    child: Column(
                      children: [
                        Text(
                          pastDays[i]['date']!,
                          style: TextStyle(
                            color: i == pastDays.length - 1
                                ? Colors.white
                                : Colors.black,
                            fontSize: 20.0,
                          ),
                        ),
                        Text(
                          pastDays[i]['day']!,
                          style: TextStyle(
                            color: i == pastDays.length - 1
                                ? Colors.white
                                : const Color.fromARGB(255, 0, 0, 0),
                            fontSize: 14.0,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
              const SizedBox(width: 5.0),
            ],
          ],
        ),
      ),
    );
  }
}
