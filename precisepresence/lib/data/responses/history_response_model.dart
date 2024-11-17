import 'dart:convert';

class HistoryResponseModel {
  final String? message;
  final List<History>? data;

  HistoryResponseModel({
    this.message,
    this.data,
  });

  factory HistoryResponseModel.fromJson(String str) =>
      HistoryResponseModel.fromMap(json.decode(str));

  String toJson() => json.encode(toMap());

  factory HistoryResponseModel.fromMap(Map<String, dynamic> json) =>
      HistoryResponseModel(
        message: json["message"],
        data: json["data"] == null
            ? []
            : List<History>.from(json["data"]!.map((x) => History.fromMap(x))),
      );

  Map<String, dynamic> toMap() => {
        "message": message,
        "data":
            data == null ? [] : List<dynamic>.from(data!.map((x) => x.toMap())),
      };
}

class History {
  final int? id;
  final int? idKaryawan;
  final String? lon;
  final String? lat;
  final String? fotoCheckin;
  final String? fotoCheckout;
  final DateTime? checkInTime;
  final DateTime? checkOutTime;
  final String? status;
  final dynamic lemburStartTime;
  final dynamic lemburEndTime;
  final dynamic durasiLembur;
  final String? keterangan;
  final DateTime? createdAt;
  final DateTime? updatedAt;

  History({
    this.id,
    this.idKaryawan,
    this.lon,
    this.lat,
    this.fotoCheckin,
    this.fotoCheckout,
    this.checkInTime,
    this.checkOutTime,
    this.status,
    this.lemburStartTime,
    this.lemburEndTime,
    this.durasiLembur,
    this.keterangan,
    this.createdAt,
    this.updatedAt,
  });

  factory History.fromJson(String str) => History.fromMap(json.decode(str));

  String toJson() => json.encode(toMap());

  factory History.fromMap(Map<String, dynamic> json) => History(
        id: json["id"],
        idKaryawan: json["id_karyawan"],
        lon: json["lon"],
        lat: json["lat"],
        fotoCheckin: json["foto_checkin"],
        fotoCheckout: json["foto_checkout"],
        checkInTime: json["check_in_time"] == null
            ? null
            : DateTime.parse(json["check_in_time"]),
        checkOutTime: json["check_out_time"] == null
            ? null
            : DateTime.parse(json["check_out_time"]),
        status: json["status"],
        lemburStartTime: json["lembur_start_time"],
        lemburEndTime: json["lembur_end_time"],
        durasiLembur: json["durasi_lembur"],
        keterangan: json["keterangan"],
        createdAt: json["created_at"] == null
            ? null
            : DateTime.parse(json["created_at"]),
        updatedAt: json["updated_at"] == null
            ? null
            : DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toMap() => {
        "id": id,
        "id_karyawan": idKaryawan,
        "lon": lon,
        "lat": lat,
        "foto_checkin": fotoCheckin,
        "foto_checkout": fotoCheckout,
        "check_in_time": checkInTime?.toIso8601String(),
        "check_out_time": checkOutTime?.toIso8601String(),
        "status": status,
        "lembur_start_time": lemburStartTime,
        "lembur_end_time": lemburEndTime,
        "durasi_lembur": durasiLembur,
        "keterangan": keterangan,
        "created_at": createdAt?.toIso8601String(),
        "updated_at": updatedAt?.toIso8601String(),
      };
}
