import 'package:intl/intl.dart'; // Import intl

class HistoryResponseModel {
  String message;
  List<HistoryData> data;

  HistoryResponseModel({required this.message, required this.data});

  factory HistoryResponseModel.fromJson(Map<String, dynamic> json) {
    return HistoryResponseModel(
      message: json['message'],
      data: (json['data'] as List)
          .map((item) => HistoryData.fromJson(item))
          .toList(),
    );
  }
}

class HistoryData {
  int id;
  int idKaryawan;
  String lon;
  String lat;
  String? fotoCheckin;
  String? fotoCheckout;
  String? checkInTime;
  String? checkOutTime;
  String status;
  String? lemburStartTime;
  String? lemburEndTime;
  String? durasiLembur;
  String keterangan;
  String createdAt;
  String updatedAt;

  HistoryData({
    required this.id,
    required this.idKaryawan,
    required this.lon,
    required this.lat,
    this.fotoCheckin,
    this.fotoCheckout,
    this.checkInTime,
    this.checkOutTime,
    required this.status,
    this.lemburStartTime,
    this.lemburEndTime,
    this.durasiLembur,
    required this.keterangan,
    required this.createdAt,
    required this.updatedAt,
  });

  factory HistoryData.fromJson(Map<String, dynamic> json) {
    return HistoryData(
      id: json['id'],
      idKaryawan: json['id_karyawan'],
      lon: json['lon'],
      lat: json['lat'],
      fotoCheckin: json['foto_checkin'],
      fotoCheckout: json['foto_checkout'],
      checkInTime: json['check_in_time'],
      checkOutTime: json['check_out_time'],
      status: json['status'],
      lemburStartTime: json['lembur_start_time'],
      lemburEndTime: json['lembur_end_time'],
      durasiLembur: json['durasi_lembur'],
      keterangan: json['keterangan'],
      createdAt: formatDate(json['created_at']),
      updatedAt: formatDate(json['updated_at']),
    );
  }
}

// Fungsi untuk memformat tanggal
String formatDate(String dateString) {
  final DateTime dateTime = DateTime.parse(dateString);
  final DateFormat formatter = DateFormat('dd MMM yyyy, HH:mm');
  return formatter.format(dateTime);
}
