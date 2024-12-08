import 'dart:io';
import 'package:flutter/material.dart';
import 'package:dotted_border/dotted_border.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:file_picker/file_picker.dart';
import 'package:precisepresence/data/datasource/LeaveRequestRemoteDatasource.dart';

class RequestLeavePage extends StatefulWidget {
  const RequestLeavePage({super.key});

  @override
  State<RequestLeavePage> createState() => _RequestLeavePageState();
}

class _RequestLeavePageState extends State<RequestLeavePage> {
  final TextEditingController _leaveTypeController = TextEditingController();
  final TextEditingController _startDateController = TextEditingController();
  final TextEditingController _endDateController = TextEditingController();
  File? _selectedFile;
  bool _isSubmitting = false;

  Future<void> _selectDate(
      BuildContext context, TextEditingController controller) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2100),
    );
    if (picked != null) {
      setState(() {
        controller.text =
            picked.toIso8601String().substring(0, 10); // Format: yyyy-MM-dd
      });
    }
  }

  Future<void> _selectFile() async {
    final result = await FilePicker.platform.pickFiles(
      type: FileType.custom,
      allowedExtensions: ['pdf', 'doc', 'docx'],
    );

    if (result != null && result.files.single.path != null) {
      setState(() {
        _selectedFile = File(result.files.single.path!);
      });
    }
  }

  Future<void> _submitRequest() async {
    if (_leaveTypeController.text.isEmpty ||
        _startDateController.text.isEmpty ||
        _endDateController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text("Harap lengkapi semua input!")),
      );
      return;
    }

    setState(() {
      _isSubmitting = true;
    });

    try {
      final leaveRequestDatasource = LeaveRequestRemoteDatasource();
      final response = await leaveRequestDatasource.submitLeaveRequest(
        jenisIzin: _leaveTypeController.text,
        tanggalMulai: _startDateController.text,
        tanggalSelesai: _endDateController.text,
        keterangan: "Keterangan opsional",
        dokumenPendukung: _selectedFile,
      );

      response.fold(
        (error) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text("Error: $error")),
          );
        },
        (success) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(content: Text("Request berhasil diajukan!")),
          );
          // Reset form after successful submission
          setState(() {
            _leaveTypeController.clear();
            _startDateController.clear();
            _endDateController.clear();
            _selectedFile = null;
          });
        },
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Terjadi kesalahan: $e")),
      );
    } finally {
      setState(() {
        _isSubmitting = false;
      });
    }
  }

  Widget _buildInputField({
    required String label,
    required TextEditingController controller,
    VoidCallback? onTap,
    bool isReadOnly = false,
    Widget? trailingIcon,
  }) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
      decoration: BoxDecoration(
        border: Border.all(color: const Color.fromRGBO(11, 62, 131, 1)),
        borderRadius: BorderRadius.circular(5),
      ),
      child: InkWell(
        onTap: onTap,
        child: Stack(
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: const TextStyle(
                    fontSize: 13,
                    fontWeight: FontWeight.w400,
                    color: Color.fromRGBO(11, 62, 131, 1),
                  ),
                ),
                TextField(
                  controller: controller,
                  readOnly: isReadOnly,
                  decoration: const InputDecoration(
                    border: InputBorder.none,
                    isDense: true,
                    contentPadding: EdgeInsets.symmetric(vertical: 4),
                  ),
                  style: const TextStyle(
                    fontSize: 13,
                    fontWeight: FontWeight.w300,
                  ),
                ),
              ],
            ),
            if (trailingIcon != null)
              Positioned(
                bottom: 0,
                right: 0,
                child: Padding(
                  padding: const EdgeInsets.only(bottom: 10),
                  child: trailingIcon,
                ),
              ),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(top: 40, bottom: 20),
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
      decoration: BoxDecoration(
        border: Border.all(color: const Color.fromRGBO(11, 62, 131, 1)),
        borderRadius: BorderRadius.circular(5),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisSize: MainAxisSize.min,
        children: [
          const Text(
            "Add Request Leave",
            style: TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.w600,
            ),
          ),
          const SizedBox(height: 12),
          _buildInputField(
            label: "Leave Type",
            controller: _leaveTypeController,
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              Expanded(
                child: _buildInputField(
                  label: "Start Date",
                  controller: _startDateController,
                  onTap: () => _selectDate(context, _startDateController),
                  isReadOnly: true,
                  trailingIcon: SvgPicture.asset(
                    "assets/images/calendar.svg",
                    width: 20,
                    height: 20,
                  ),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildInputField(
                  label: "End Date",
                  controller: _endDateController,
                  onTap: () => _selectDate(context, _endDateController),
                  isReadOnly: true,
                  trailingIcon: SvgPicture.asset(
                    "assets/images/calendar.svg",
                    width: 20,
                    height: 20,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          GestureDetector(
            onTap: _selectFile,
            child: Container(
              padding: const EdgeInsets.all(16.0),
              decoration: BoxDecoration(
                border: Border.all(color: const Color.fromRGBO(11, 62, 131, 1)),
                borderRadius: BorderRadius.circular(5),
              ),
              child: Column(
                children: [
                  Row(
                    children: const [
                      Text(
                        "Supporting Document",
                        style: TextStyle(
                          fontSize: 13,
                          fontWeight: FontWeight.w400,
                          color: Color.fromRGBO(11, 62, 131, 1),
                        ),
                      ),
                      Text(
                        " (Optional)",
                        style: TextStyle(
                          fontSize: 13,
                          fontWeight: FontWeight.w400,
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 8),
                  DottedBorder(
                    radius: const Radius.circular(5),
                    strokeWidth: 1,
                    color: const Color.fromRGBO(93, 93, 93, 0.8),
                    dashPattern: const [6, 4],
                    child: SizedBox(
                      width: MediaQuery.of(context).size.width,
                      height: 65,
                      child: Center(
                        child: _selectedFile != null
                            ? Text(
                                _selectedFile!.path.split('/').last,
                                style: const TextStyle(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w300,
                                ),
                              )
                            : SvgPicture.asset(
                                "assets/images/document.svg",
                                width: 50,
                                height: 50,
                              ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
          const SizedBox(height: 16),
          Center(
            child: ElevatedButton(
              onPressed: _isSubmitting ? null : _submitRequest,
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color.fromRGBO(11, 62, 131, 1),
                padding:
                    const EdgeInsets.symmetric(horizontal: 34, vertical: 12),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(18),
                ),
              ),
              child: _isSubmitting
                  ? const CircularProgressIndicator(color: Colors.white)
                  : const Text(
                      "Submit",
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 14,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
            ),
          ),
        ],
      ),
    );
  }
}
