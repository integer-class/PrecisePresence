class ActivityData {
  final String date;
  final String status;
  final String checkIn;
  final String checkOut;
  final String late;

  ActivityData({
    required this.date,
    required this.status,
    required this.checkIn,
    required this.checkOut,
    required this.late,
  });

  factory ActivityData.fromJson(Map<String, dynamic> json) {
    return ActivityData(
      date: json['date'],
      status: json['status'],
      checkIn: json['check_in'],
      checkOut: json['check_out'],
      late: json['late'],
    );
  }
}
