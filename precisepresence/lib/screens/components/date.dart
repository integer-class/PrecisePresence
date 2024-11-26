import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:precisepresence/constants/colors.dart'; // Gantilah dengan warna yang sesuai

class DateComponent extends StatefulWidget {
  final Function(String)
      onDateSelected; // Callback untuk mengirimkan tanggal yang dipilih

  const DateComponent({Key? key, required this.onDateSelected})
      : super(key: key);

  @override
  _DateComponentState createState() => _DateComponentState();
}

class _DateComponentState extends State<DateComponent> {
  String selectedDate = DateFormat('yyyy-MM-dd').format(DateTime.now());

  // Fungsi untuk generate tanggal 6 hari terakhir
  List<Map<String, String>> generateLastSixDays() {
    List<Map<String, String>> days = [];
    DateTime today = DateTime.now();
    DateFormat dayFormat = DateFormat('EEE');
    DateFormat dateFormat = DateFormat('dd');

    for (int i = 5; i >= 0; i--) {
      DateTime currentDate = today.subtract(Duration(days: i));
      String day = dayFormat.format(currentDate);
      String date = dateFormat.format(currentDate);
      String formattedDate = DateFormat('yyyy-MM-dd').format(currentDate);

      days.add({'day': day, 'date': date, 'fullDate': formattedDate});
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
              GestureDetector(
                onTap: () {
                  setState(() {
                    selectedDate = pastDays[i]['fullDate']!;
                  });
                  widget.onDateSelected(selectedDate);

                  print("Tanggal yang dipilih: $selectedDate");
                },
                child: Column(
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(
                          vertical: 10.0, horizontal: 20.0),
                      decoration: BoxDecoration(
                        color: selectedDate == pastDays[i]['fullDate']
                            ? AppColors.primary
                            : Colors.white,
                        borderRadius: BorderRadius.circular(10.0),
                      ),
                      child: Column(
                        children: [
                          Text(
                            pastDays[i]['date']!,
                            style: TextStyle(
                              color: selectedDate == pastDays[i]['fullDate']
                                  ? Colors.white
                                  : Colors.black,
                              fontSize: 20.0,
                            ),
                          ),
                          Text(
                            pastDays[i]['day']!,
                            style: TextStyle(
                              color: selectedDate == pastDays[i]['fullDate']
                                  ? Colors.white
                                  : AppColors.black,
                              fontSize: 14.0,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(width: 5.0),
            ],
          ],
        ),
      ),
    );
  }
}
