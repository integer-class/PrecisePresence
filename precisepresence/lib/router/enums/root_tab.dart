part of '../app_router.dart';

enum RootTab {
  home('0'),
  history('1'),
  perizinan('2'),
  profile('3'),
  presensi('4');

  final String value;
  const RootTab(this.value);

  factory RootTab.fromIndex(int index) {
    return values.firstWhere(
      (value) => value.value == '$index',
      orElse: () => RootTab.home,
    );
  }
}
