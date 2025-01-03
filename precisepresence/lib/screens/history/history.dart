import 'package:flutter/material.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/data/datasource/history_remote_datasource.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';
import 'package:precisepresence/data/responses/history_response_model.dart';
import 'package:intl/intl.dart'; // Import intl

class HistoryPage extends StatefulWidget {
  const HistoryPage({Key? key}) : super(key: key);

  @override
  _HistoryPageState createState() => _HistoryPageState();
}

class _HistoryPageState extends State<HistoryPage> {
  late Future<HistoryResponseModel> _historyData;

  @override
  void initState() {
    super.initState();
    _historyData = HistoryRemoteDatasource().getHistory().then(
          (either) => either.fold(
            (l) => throw Exception(l), // Handle error
            (r) => r,
          ),
        );
  }

  // Fungsi untuk memformat waktu ke format jam (HH:mm)
  String formatTime(String? timeString) {
    if (timeString == null || timeString.isEmpty) {
      return "Belum Absen"; // Mengembalikan "Belum Absen" jika waktu null
    }
    final DateTime dateTime = DateTime.parse(timeString);
    final DateFormat formatter = DateFormat('HH:mm');
    return formatter.format(dateTime);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("History"),
      ),
      body: FutureBuilder<HistoryResponseModel>(
        future: _historyData,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData) {
            return Center(child: Text('No data available'));
          } else {
            final history = snapshot.data!;
            return ListView.builder(
              padding: const EdgeInsets.all(20.0),
              itemCount: history.data.length,
              itemBuilder: (context, index) {
                final item = history.data[index];
                return Container(
                  padding: const EdgeInsets.all(20.0),
                  margin: const EdgeInsets.only(bottom: 10.0),
                  decoration: BoxDecoration(
                    color: Colors.blue[100],
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  child: Column(
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Text(
                            item.waktuAbsensi,
                            style: TextStyle(
                              color: AppColors.primary,
                              fontSize: 15.0,
                            ),
                          ),
                          Text(
                            item.statusAbsensi,
                            style: TextStyle(
                              color: Color.fromARGB(143, 255, 0, 0),
                              fontWeight: FontWeight.bold,
                              fontSize: 15.0,
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 15),
                      Row(
                        children: [
                          Expanded(
                            child: Text(
                              'Successfully attendance ${item.nama_jenis_absensi}',
                              style: const TextStyle(
                                color: Color(0xFFED7D2B),
                                fontWeight: FontWeight.bold,
                                fontSize: 19.0,
                              ),
                              maxLines: 2,
                              overflow: TextOverflow.ellipsis,
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 10),
                    ],
                  ),
                );
              },
            );
          }
        },
      ),
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: CustomBottomAppBar(currentTab: RootTab.history),
    );
  }
}
