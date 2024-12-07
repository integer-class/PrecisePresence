import 'package:dotted_border/dotted_border.dart';
import 'package:file_picker/file_picker.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:precisepresence/screens/components/CustomBottomAppBar.dart';
import 'package:precisepresence/router/app_router.dart';
import 'package:precisepresence/screens/components/custom_floating_action_button.dart';

class LeavesPage extends StatefulWidget {
  const LeavesPage({super.key});

  @override
  State<LeavesPage> createState() => _LeavesPageState();
}

class _LeavesPageState extends State<LeavesPage> {
  final TextEditingController _leaveTypeController = TextEditingController();
  final TextEditingController _startDateController = TextEditingController();
  final TextEditingController _endDateController = TextEditingController();
  String? _selectedFileName;

  Future<void> _selectDate(
      BuildContext context, TextEditingController controller) async {
    DateTime? pickedDate = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2101),
    );

    if (pickedDate != null) {
      setState(() {
        controller.text = pickedDate.toLocal().toString().split(' ')[0];
      });
    }
  }

  Future<void> _selectFile() async {
    // Placeholder for file selection logic
    FilePickerResult? result = await FilePicker.platform.pickFiles();

    if (result != null) {
      setState(() {
        // File file = File(result.files.single.path!);
        _selectedFileName = result.files.single.name;
      });
    } else {
      // User canceled the picker
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        title: const Text(
          "My Leaves",
          style: TextStyle(
            color: Color.fromRGBO(12, 57, 120, 1),
            fontSize: 16,
            fontWeight: FontWeight.w700,
          ),
        ),
        iconTheme: const IconThemeData(
            color: Color.fromRGBO(
                12, 57, 120, 1) // Customize the back button color
            ),
        backgroundColor: const Color.fromRGBO(208, 228, 255, 1),
        elevation: 0.0,
        surfaceTintColor: Colors.transparent,
      ),
      body: SingleChildScrollView(
        scrollDirection: Axis.vertical,
        child: Stack(
          alignment: Alignment.topLeft,
          children: [
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 28),
              child: Column(
                children: [
                  Container(
                    margin: const EdgeInsets.only(top: 40, bottom: 20),
                    padding: const EdgeInsets.symmetric(
                        horizontal: 24, vertical: 16),
                    decoration: BoxDecoration(
                      border: const Border.fromBorderSide(
                        BorderSide(
                          color: Color.fromRGBO(11, 62, 131, 1),
                        ),
                      ),
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

                        // Leave Type Input
                        Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 12, vertical: 4),
                          decoration: BoxDecoration(
                            border: const Border.fromBorderSide(
                              BorderSide(
                                color: Color.fromRGBO(11, 62, 131, 1),
                              ),
                            ),
                            borderRadius: BorderRadius.circular(5),
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const Text(
                                "Leave Type",
                                style: TextStyle(
                                    fontSize: 13,
                                    fontWeight: FontWeight.w400,
                                    color: Color.fromRGBO(11, 62, 131, 1)),
                              ),
                              TextField(
                                controller: _leaveTypeController,
                                decoration: const InputDecoration(
                                  border: InputBorder.none,
                                  isDense: true,
                                  contentPadding:
                                      EdgeInsets.symmetric(vertical: 4),
                                ),
                                style: const TextStyle(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w300,
                                ),
                              ),
                            ],
                          ),
                        ),
                        const SizedBox(height: 16),

                        // Start Date and End Date Input
                        Row(
                          children: [
                            Expanded(
                              child: Container(
                                padding: const EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 4),
                                decoration: BoxDecoration(
                                  border: const Border.fromBorderSide(
                                    BorderSide(
                                      color: Color.fromRGBO(11, 62, 131, 1),
                                    ),
                                  ),
                                  borderRadius: BorderRadius.circular(5),
                                ),
                                child: InkWell(
                                  onTap: () => _selectDate(
                                      context, _startDateController),
                                  child: Stack(
                                    children: [
                                      Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          const Text(
                                            "Start Date",
                                            style: TextStyle(
                                                fontSize: 13,
                                                fontWeight: FontWeight.w400,
                                                color: Color.fromRGBO(
                                                    11, 62, 131, 1)),
                                          ),
                                          SizedBox(
                                              height: 27,
                                              child: Text(
                                                _startDateController.text,
                                                style: const TextStyle(
                                                  fontSize: 13,
                                                  fontWeight: FontWeight.w300,
                                                ),
                                              )),
                                        ],
                                      ),
                                      Positioned(
                                        bottom: 0,
                                        right: 0,
                                        child: Padding(
                                          padding:
                                              const EdgeInsets.only(bottom: 10),
                                          child: SvgPicture.asset(
                                              "assets/images/calendar.svg"),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                            const SizedBox(width: 12),
                            Expanded(
                              child: Container(
                                padding: const EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 4),
                                decoration: BoxDecoration(
                                  border: const Border.fromBorderSide(
                                    BorderSide(
                                      color: Color.fromRGBO(11, 62, 131, 1),
                                    ),
                                  ),
                                  borderRadius: BorderRadius.circular(5),
                                ),
                                child: InkWell(
                                  onTap: () =>
                                      _selectDate(context, _endDateController),
                                  child: Stack(
                                    children: [
                                      Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          const Text(
                                            "End Date",
                                            style: TextStyle(
                                                fontSize: 13,
                                                fontWeight: FontWeight.w400,
                                                color: Color.fromRGBO(
                                                    11, 62, 131, 1)),
                                          ),
                                          SizedBox(
                                              height: 27,
                                              child: Text(
                                                _endDateController.text,
                                                style: const TextStyle(
                                                  fontSize: 13,
                                                  fontWeight: FontWeight.w300,
                                                ),
                                              )),
                                        ],
                                      ),
                                      Positioned(
                                        bottom: 0,
                                        right: 0,
                                        child: Padding(
                                          padding:
                                              const EdgeInsets.only(bottom: 10),
                                          child: SvgPicture.asset(
                                              "assets/images/calendar.svg"),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 16),

                        // Supporting Document Input
                        GestureDetector(
                          onTap: _selectFile,
                          child: Container(
                            padding: const EdgeInsets.all(16.0),
                            decoration: BoxDecoration(
                              border: const Border.fromBorderSide(
                                BorderSide(
                                  color: Color.fromRGBO(11, 62, 131, 1),
                                ),
                              ),
                              borderRadius: BorderRadius.circular(5),
                            ),
                            child: Column(
                              children: [
                                const Row(
                                  mainAxisAlignment: MainAxisAlignment.start,
                                  children: [
                                    Text(
                                      "Supporting Document",
                                      style: TextStyle(
                                          fontSize: 13,
                                          fontWeight: FontWeight.w400,
                                          color:
                                              Color.fromRGBO(11, 62, 131, 1)),
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
                                        child: _selectedFileName != null
                                            ? Text(
                                                _selectedFileName!,
                                                style: const TextStyle(
                                                  fontSize: 13,
                                                  fontWeight: FontWeight.w300,
                                                ),
                                              )
                                            : SvgPicture.asset(
                                                "assets/images/document.svg")),
                                  ),
                                ),
                              ],
                            ),
                          ),
                        ),
                        const SizedBox(height: 16),

                        // Submit Button
                        Center(
                          child: SizedBox(
                            height: 22,
                            child: ElevatedButton(
                              onPressed: () {
                                // Handle form submission
                              },
                              style: ElevatedButton.styleFrom(
                                backgroundColor:
                                    const Color.fromRGBO(11, 62, 131, 1),
                                padding: const EdgeInsets.symmetric(
                                    horizontal: 34, vertical: 0),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(18),
                                ),
                                minimumSize: const Size(40, 22),
                              ),
                              child: const Text(
                                "Submit",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 12,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        "Request History",
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      Text(
                        "View All",
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w500,
                          color: Color.fromRGBO(66, 102, 185, 1),
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 16),
                  Container(
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
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            const Text(
                              "Tour",
                              style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.w600,
                                letterSpacing: 1.08,
                                color: Color.fromRGBO(12, 57, 120, 1),
                              ),
                            ),
                            Container(
                              width: 82,
                              decoration: const BoxDecoration(
                                color: Color.fromRGBO(255, 244, 237, 1),
                              ),
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 7, vertical: 6),
                              child: const Row(
                                children: [
                                  Icon(
                                    Icons.watch_later_outlined,
                                    size: 10,
                                    color: Color.fromRGBO(237, 125, 43, 1),
                                  ),
                                  SizedBox(width: 6),
                                  Text(
                                    "Pending",
                                    style: TextStyle(
                                      fontSize: 10,
                                      fontWeight: FontWeight.w600,
                                      letterSpacing: 1.08,
                                      color: Color.fromRGBO(237, 125, 43, 1),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 12),
                        Row(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            // SvgPicture.asset(
                            //   "assets/images/calendar.svg",
                            //   height: 20,
                            // ),
                            const SizedBox(width: 10),
                            const Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  children: [
                                    Text(
                                      "Leave from:",
                                      style: TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.w600,
                                        letterSpacing: 0.65,
                                        color: Color.fromRGBO(93, 93, 93, 1),
                                      ),
                                    ),
                                    Text(
                                      " 29 Jan - 05 Feb",
                                      style: TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.w600,
                                        letterSpacing: 0.65,
                                        color: Color.fromRGBO(12, 57, 120, 1),
                                      ),
                                    ),
                                  ],
                                ),
                                Text(
                                  "Requested on 19 Apr, 5:30pm",
                                  style: TextStyle(
                                    fontSize: 9,
                                    fontWeight: FontWeight.w500,
                                    letterSpacing: 0.45,
                                    color: Color.fromRGBO(164, 164, 165, 1),
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 20),
                  Container(
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
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            const Text(
                              "Suffering from cold",
                              style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.w600,
                                color: Color.fromRGBO(12, 57, 120, 1),
                              ),
                            ),
                            Container(
                              width: 82,
                              decoration: const BoxDecoration(
                                color: Color.fromRGBO(224, 248, 238, 1),
                              ),
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 7, vertical: 6),
                              child: const Row(
                                children: [
                                  Icon(
                                    Icons.watch_later_outlined,
                                    size: 10,
                                    color: Color.fromRGBO(7, 163, 30, 1),
                                  ),
                                  SizedBox(width: 6),
                                  Text(
                                    "Approved",
                                    style: TextStyle(
                                      fontSize: 10,
                                      fontWeight: FontWeight.w600,
                                      color: Color.fromRGBO(7, 163, 30, 1),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 12),
                        Row(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            SvgPicture.asset(
                              "assets/images/calendar.svg",
                              height: 20,
                            ),
                            const SizedBox(width: 10),
                            const Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  children: [
                                    Text(
                                      "Leave from:",
                                      style: TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.w600,
                                        letterSpacing: 0.65,
                                        color: Color.fromRGBO(93, 93, 93, 1),
                                      ),
                                    ),
                                    Text(
                                      " 19 Jan - 21 Jan",
                                      style: TextStyle(
                                        fontSize: 13,
                                        fontWeight: FontWeight.w600,
                                        letterSpacing: 0.65,
                                        color: Color.fromRGBO(12, 57, 120, 1),
                                      ),
                                    ),
                                  ],
                                ),
                                Text(
                                  "Requested on 19 Jan, 7:30pm",
                                  style: TextStyle(
                                    fontSize: 9,
                                    fontWeight: FontWeight.w500,
                                    letterSpacing: 0.45,
                                    color: Color.fromRGBO(164, 164, 165, 1),
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 40),
                ],
              ),
            ),
            Positioned(
              left: 0,
              top: -80,
              child: SizedBox(
                width: MediaQuery.of(context).size.width,
                // child: Image.asset("assets/images/appbar-blue.png"),
              ),
            ),
          ],
        ),
      ),
      floatingActionButton: CustomFloatingActionButton(
        onPressed: () {},
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      bottomNavigationBar: const CustomBottomAppBar(currentTab: RootTab.home),
    );
  }
}
