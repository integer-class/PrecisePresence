import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:intl/intl.dart';
import 'package:precisepresence/constants/colors.dart';
import 'package:precisepresence/data/datasource/history_remote_datasource.dart';
import 'package:precisepresence/data/responses/history_response_model.dart';
import 'package:precisepresence/router/app_router.dart';

class Activity extends StatefulWidget {
  const Activity({Key? key}) : super(key: key);

  @override
  State<Activity> createState() => _ActivityState();
}

class _ActivityState extends State<Activity> {
  late Future<HistoryResponseModel> _historyData;

  @override
  void initState() {
    super.initState();
    _historyData = HistoryRemoteDatasource().getHistory().then(
          (either) => either.fold(
            (l) => throw Exception(l),
            (r) => r,
          ),
        );
  }

  String formatTime(String? timeString) {
    if (timeString == null || timeString.isEmpty) {
      return "Belum Absen";
    }
    final DateTime dateTime = DateTime.parse(timeString);
    final DateFormat formatter = DateFormat('HH:mm');
    return formatter.format(dateTime);
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Container(
          padding: const EdgeInsets.all(15.0),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                "Your activity",
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 15.0,
                  fontWeight: FontWeight.bold,
                ),
              ),
              InkWell(
                onTap: () {
                  context.go('/${RootTab.history.value}');
                },
                child: Text(
                  "View All",
                  style: TextStyle(
                    color: AppColors.primary,
                    fontSize: 14.0,
                  ),
                ),
              ),
            ],
          ),
        ),
        Container(
            child: FutureBuilder<HistoryResponseModel>(
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
              return Container(
                height: MediaQuery.of(context).size.height * 0.4,
                child: ListView.builder(
                  padding: const EdgeInsets.all(10.0),
                  itemCount: history.data.take(3).length,
                  itemBuilder: (context, index) {
                    final item = history.data[index];
                    return Container(
                      padding: const EdgeInsets.all(5.0),
                      child: Column(
                        children: [
                          Container(
                            padding: const EdgeInsets.all(10.0),
                            width: double.infinity,
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(10.0),
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  mainAxisAlignment: MainAxisAlignment.start,
                                  children: [
                                    Text(
                                      item.createdAt,
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
                                      'Successfully attendance ${item.nama_jenis_absensi}',
                                      style: TextStyle(
                                        color: Color(0xFFED7D2B),
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16.0,
                                      ),
                                    ),
                                  ],
                                ),
                                const SizedBox(height: 10),
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    const Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          "Attandace Status",
                                          style: TextStyle(
                                            color: Colors.black,
                                            fontSize: 13.0,
                                          ),
                                        ),
                                      ],
                                    ),
                                    Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          item.statusAbsensi,
                                          style: const TextStyle(
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
                  },
                ),
              );
            }
          },
        ))
      ],
    );
  }
}
