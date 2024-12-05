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
  int idJadwalAbsensi;
  String lon;
  String lat;
  String foto;
  String waktuAbsensi;
  String statusAbsen;
  String statusAbsensi;
  String catatan;
  String createdAt;
  String updatedAt;

  HistoryData({
    required this.id,
    required this.idKaryawan,
    required this.idJadwalAbsensi,
    required this.lon,
    required this.lat,
    required this.foto,
    required this.waktuAbsensi,
    required this.statusAbsen,
    required this.statusAbsensi,
    required this.catatan,
    required this.createdAt,
    required this.updatedAt,
  });

  factory HistoryData.fromJson(Map<String, dynamic> json) {
    return HistoryData(
      id: json['id'],
      idKaryawan: json['id_karyawan'],
      idJadwalAbsensi: json['id_jadwal_absensi'],
      lon: json['lon'],
      lat: json['lat'],
      foto: json['foto'],
      waktuAbsensi: formatDate(json['waktu_absensi']),
      statusAbsen: json['status_absen'],
      statusAbsensi: json['status_absensi'],
      catatan: json['catatan'],
      createdAt: formatDate(json['created_at']),
      updatedAt: formatDate(json['updated_at']),
    );
  }
}

// Fungsi untuk memformat tanggal
String formatDate(String dateString) {
  final DateTime dateTime = DateTime.parse(dateString);
  final DateFormat formatter = DateFormat('dd MMM yyyy HH:mm');
  return formatter.format(dateTime);
}
