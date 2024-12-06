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
  List<dynamic>? _attendanceData;
  List<dynamic>? _scheduleData; // Variabel untuk jumlah_jadwal

  Future<void> _fetchAttendance() async {
    setState(() {
      _isLoading = true;
    });

    try {
      final response =
          await _apiService.fetchAttendanceByDate(widget.selectedDate);
      setState(() {
        _attendanceData = response['data']; // Data absensi
        _scheduleData = response['jumlah_jadwal']; // Data jumlah_jadwal
      });
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Error fetching attendance: $e")),
        );
        print("Error: $e");
      }
    } finally {
      setState(() {
        _isLoading = false;
      });
    }
  }

  @override
  void didUpdateWidget(covariant TodayAttendance oldWidget) {
    super.didUpdateWidget(oldWidget);
    if (oldWidget.selectedDate != widget.selectedDate) {
      _fetchAttendance();
    }
  }

  @override
  void initState() {
    super.initState();
    _fetchAttendance();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(20.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            "Today's Attendance",
            style: TextStyle(
              color: Colors.black,
              fontSize: 15.0,
              fontWeight: FontWeight.bold,
            ),
          ),
          const SizedBox(height: 15),
          if (_scheduleData != null && _scheduleData!.isNotEmpty)
            Wrap(
              spacing: 16.0, // Spasi horizontal antara elemen
              runSpacing: 16.0, // Spasi vertikal antara elemen
              children: _scheduleData!.map((schedule) {
                String namaJenisAbsensi = schedule['jenis_absensi']
                        ['nama_jenis_absensi'] ??
                    'Belum Terjadwal';

                // Mencari data absensi berdasarkan id_jadwal_absensi
                String waktu = 'Belum Terjadwal';
                String statusAbsensi = 'Status tidak tersedia';
                for (var attendance in _attendanceData!) {
                  if (attendance['id_jadwal_absensi'] ==
                      schedule['id_jadwal_absensi']) {
                    waktu = attendance['waktu_absensi'] ?? 'Belum Terjadwal';
                    statusAbsensi =
                        attendance['status_absensi'] ?? 'Status tidak tersedia';
                    break;
                  }
                }

                return Container(
                  width: MediaQuery.of(context).size.width *
                      0.4, // Lebar 40% layar
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
                        '$namaJenisAbsensi',
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 20.0,
                        ),
                      ),
                      const SizedBox(height: 10),
                      Text(
                        'Waktu: $waktu',
                        style: TextStyle(
                          color: AppColors.primary,
                          fontSize: 13.0,
                        ),
                      ),
                    ],
                  ),
                );
              }).toList(),
            )
          else
            const Text(
              'Tidak ada jadwal tersedia.',
              style: TextStyle(
                color: Colors.black,
                fontSize: 13.0,
              ),
            ),
        ],
      ),
    );
  }
}
