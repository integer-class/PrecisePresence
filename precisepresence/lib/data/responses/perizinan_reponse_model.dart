class LeaveRequest {
  final String id;
  final String jenisIzin;
  final String tanggalMulai;
  final String tanggalSelesai;
  final String keterangan;
  final String status;
  final String createdAt;
  final String updatedAt;
  final String idKaryawan;
  final bool isActive;
  final String? dokumenPendukung;

  LeaveRequest({
    required this.id,
    required this.jenisIzin,
    required this.tanggalMulai,
    required this.tanggalSelesai,
    required this.keterangan,
    required this.status,
    required this.createdAt,
    required this.updatedAt,
    required this.idKaryawan,
    required this.isActive,
    this.dokumenPendukung,
  });

  factory LeaveRequest.fromJson(Map<String, dynamic> json) {
    return LeaveRequest(
      id: json['id'].toString(),
      jenisIzin: json['jenis_izin'],
      tanggalMulai: json['tanggal_mulai'],
      tanggalSelesai: json['tanggal_selesai'],
      keterangan: json['keterangan'],
      status: json['status'],
      createdAt: json['created_at'],
      updatedAt: json['updated_at'],
      idKaryawan: json['id_karyawan'].toString(),
      isActive: json['is_active'] == 1,
      dokumenPendukung: json['dokumen_pendukung'],
    );
  }
}
