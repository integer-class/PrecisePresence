import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:intl/intl.dart';
import 'package:precisepresence/data/datasource/api_service.dart';

class TodayAttendance extends StatefulWidget {
  final String selectedDate;

  const TodayAttendance({super.key, required this.selectedDate});

  @override
  State<TodayAttendance> createState() => _TodayAttandanceState();
}

class _TodayAttandanceState extends State<TodayAttendance> {
  final ApiService _apiService = ApiService();
  bool _isLoading = false;
  Map<String, dynamic>? _attendanceData;

  Future<void> _fetchAttendance() async {
    if (!mounted)
      return; // Pastikan widget masih aktif sebelum melakukan setState
    setState(() {
      _isLoading = true;
    });

    try {
      final data = await _apiService.fetchAttendanceByDate(widget.selectedDate);
      if (mounted) {
        setState(() {
          _attendanceData = data['data'];
        });
      }
    } catch (e) {
      if (mounted) {
        // ScaffoldMessenger.of(context).showSnackBar(
        //   SnackBar(content: Text("Error fetching attendance: $e")),
        // );

        print(e);
      }
    } finally {
      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    }
  }

  @override
  void didUpdateWidget(covariant TodayAttendance oldWidget) {
    super.didUpdateWidget(oldWidget);
    if (oldWidget.selectedDate != widget.selectedDate) {
      _fetchAttendance(); // Refresh data saat tanggal berubah
    }
  }

  @override
  void initState() {
    super.initState();
    _fetchAttendance();
  }

  @override
  Widget build(BuildContext context) {
    bool hasAttendanceData = _attendanceData != null;
    var attendance = _attendanceData ?? {};

    String formatTime(String? time) {
      return time != null
          ? DateFormat.jm().format(DateTime.parse(time))
          : 'Belum Absen';
    }

    return Container(
      padding: const EdgeInsets.all(20.0),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.start,
            children: const [
              Text(
                "Today's Attendance",
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 15.0,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
          SizedBox(height: 15),
          Row(
            children: [
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  padding: const EdgeInsets.all(20.0),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Container(
                            alignment: Alignment.topLeft,
                            padding: const EdgeInsets.all(5.0),
                            decoration: BoxDecoration(
                              color: AppColors.primary,
                              borderRadius: BorderRadius.circular(3.0),
                            ),
                            child: const Icon(
                              CupertinoIcons.square_arrow_right,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(width: 10),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Check In',
                                style: const TextStyle(
                                  color: Colors.black,
                                  fontSize: 13.0,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                      Text(
                        formatTime(attendance['check_in_time']),
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 20.0,
                        ),
                      ),
                      const SizedBox(height: 10),
                      Text(
                        attendance['keterangan'] ?? 'No comment',
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 13.0,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              const SizedBox(width: 10),
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 255, 255, 255),
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  padding: const EdgeInsets.all(20.0),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Container(
                            alignment: Alignment.topLeft,
                            padding: const EdgeInsets.all(5.0),
                            decoration: BoxDecoration(
                              color: AppColors.primary,
                              borderRadius: BorderRadius.circular(3.0),
                            ),
                            child: const Icon(
                              CupertinoIcons.square_arrow_left,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(width: 10),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Check Out',
                                style: const TextStyle(
                                  color: Colors.black,
                                  fontSize: 13.0,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                      Text(
                        formatTime(attendance['check_out_time']),
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 20.0,
                        ),
                      ),
                      const SizedBox(height: 10),
                      Text(
                        attendance['keterangan'] ?? 'No comment',
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 13.0,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          ),
          SizedBox(height: 10),
          Row(
            children: [
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  padding: const EdgeInsets.all(20.0),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Container(
                            alignment: Alignment.topLeft,
                            padding: const EdgeInsets.all(5.0),
                            decoration: BoxDecoration(
                              color: AppColors.primary,
                              borderRadius: BorderRadius.circular(3.0),
                            ),
                            child: const Icon(
                              CupertinoIcons.square_arrow_right,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(width: 10),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Overtime In',
                                style: const TextStyle(
                                  color: Colors.black,
                                  fontSize: 13.0,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                      Text(
                        formatTime(attendance['lembur_start_time']),
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 20.0,
                        ),
                      ),
                      const SizedBox(height: 10),
                    ],
                  ),
                ),
              ),
              const SizedBox(width: 10),
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: const Color.fromARGB(255, 255, 255, 255),
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  padding: const EdgeInsets.all(20.0),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Container(
                            alignment: Alignment.topLeft,
                            padding: const EdgeInsets.all(5.0),
                            decoration: BoxDecoration(
                              color: AppColors.primary,
                              borderRadius: BorderRadius.circular(3.0),
                            ),
                            child: const Icon(
                              CupertinoIcons.square_arrow_right,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(width: 10),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                'Overtime Out',
                                style: const TextStyle(
                                  color: Colors.black,
                                  fontSize: 13.0,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                      Text(
                        formatTime(attendance['lembur_end_time']),
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 20.0,
                        ),
                      ),
                      const SizedBox(height: 10),
                    ],
                  ),
                ),
              ),
            ],
          ),
          SizedBox(height: 10),
        ],
      ),
    );
  }
}
