import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:precisepresence/data/datasource/LeaveRequestRemoteDatasource.dart';
import 'package:precisepresence/data/responses/perizinan_reponse_model.dart';

class HistoryPerizinan extends StatefulWidget {
  const HistoryPerizinan({super.key});
  @override
  State<HistoryPerizinan> createState() => _HistoryPerizinanState();
}

class _HistoryPerizinanState extends State<HistoryPerizinan> {
  final LeaveRequestRemoteDatasource _datasource =
      LeaveRequestRemoteDatasource();
  List<LeaveRequest> _leaveRequests = [];
  bool _isLoading = true;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _fetchLeaveRequests();
  }

  Future<void> _fetchLeaveRequests() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    final result = await _datasource.getLeaveRequests();
    result.fold(
      (error) {
        setState(() {
          _errorMessage = error;
          _isLoading = false;
        });
      },
      (leaveRequests) {
        setState(() {
          _leaveRequests = leaveRequests;
          _isLoading = false;
        });
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return _isLoading
        ? const Center(child: CircularProgressIndicator())
        : _errorMessage != null
            ? Center(child: Text(_errorMessage!))
            : _leaveRequests.isEmpty
                ? const Center(child: Text("No leave requests found."))
                : SizedBox(
                    height: MediaQuery.of(context).size.height * 0.6,
                    child: ListView.builder(
                      itemCount: _leaveRequests.length,
                      itemBuilder: (context, index) {
                        final leave = _leaveRequests[index];
                        return Padding(
                          padding: const EdgeInsets.only(bottom: 20),
                          child: Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 16, vertical: 20),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(10),
                              boxShadow: const [
                                BoxShadow(
                                  color: Color.fromRGBO(0, 0, 0, 0.25),
                                  offset: Offset(0, 4),
                                  blurRadius: 4,
                                ),
                              ],
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    Flexible(
                                      child: Text(
                                        leave.jenisIzin,
                                        style: const TextStyle(
                                          fontSize: 18,
                                          fontWeight: FontWeight.w600,
                                          letterSpacing: 1.08,
                                          color: Color.fromRGBO(12, 57, 120, 1),
                                        ),
                                        overflow: TextOverflow.ellipsis,
                                      ),
                                    ),
                                    Container(
                                      width: 82,
                                      decoration: BoxDecoration(
                                        color: leave.status == "Approved"
                                            ? const Color.fromRGBO(
                                                224, 248, 238, 1)
                                            : const Color.fromRGBO(
                                                255, 244, 237, 1),
                                      ),
                                      padding: const EdgeInsets.symmetric(
                                          horizontal: 7, vertical: 6),
                                      child: Row(
                                        children: [
                                          Icon(
                                            Icons.watch_later_outlined,
                                            size: 10,
                                            color: leave.status == "Approved"
                                                ? const Color.fromRGBO(
                                                    7, 163, 30, 1)
                                                : const Color.fromRGBO(
                                                    237, 125, 43, 1),
                                          ),
                                          const SizedBox(width: 6),
                                          Text(
                                            leave.status,
                                            style: TextStyle(
                                              fontSize: 10,
                                              fontWeight: FontWeight.w600,
                                              color: leave.status == "Approved"
                                                  ? const Color.fromRGBO(
                                                      7, 163, 30, 1)
                                                  : const Color.fromRGBO(
                                                      237, 125, 43, 1),
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                  ],
                                ),
                                const SizedBox(height: 12),
                                Row(
                                  children: [
                                    SvgPicture.asset(
                                      "assets/images/calendar.svg",
                                      height: 20,
                                    ),
                                    const SizedBox(width: 10),
                                    Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Row(
                                          children: [
                                            const Text(
                                              "Leave from:",
                                              style: TextStyle(
                                                fontSize: 13,
                                                fontWeight: FontWeight.w600,
                                                letterSpacing: 0.65,
                                                color: Color.fromRGBO(
                                                    93, 93, 93, 1),
                                              ),
                                            ),
                                            Text(
                                              " ${leave.tanggalMulai} - ${leave.tanggalSelesai}",
                                              style: const TextStyle(
                                                fontSize: 13,
                                                fontWeight: FontWeight.w600,
                                                letterSpacing: 0.65,
                                                color: Color.fromRGBO(
                                                    12, 57, 120, 1),
                                              ),
                                            ),
                                          ],
                                        ),
                                        Text(
                                          "Requested on ${leave.createdAt}",
                                          style: const TextStyle(
                                            fontSize: 9,
                                            fontWeight: FontWeight.w500,
                                            letterSpacing: 0.45,
                                            color: Color.fromRGBO(
                                                164, 164, 165, 1),
                                          ),
                                        ),
                                      ],
                                    ),
                                  ],
                                ),
                              ],
                            ),
                          ),
                        );
                      },
                    ),
                  );
  }
}
