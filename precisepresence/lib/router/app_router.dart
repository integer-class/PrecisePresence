import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/screens/history/history.dart';
import 'package:precisepresence/screens/home/home.dart';
import 'package:precisepresence/screens/intro/splash_page.dart';
import 'package:precisepresence/screens/auth/login.dart';
import 'package:precisepresence/screens/presensi/presensi.dart';
import 'package:precisepresence/screens/presensi/presensi_checkout.dart'; // Halaman checkout presensi
import 'package:precisepresence/screens/profile/profile.dart';

part 'enums/root_tab.dart';
part 'route_constants.dart';

class AppRouter {
  final GoRouter router = GoRouter(
    initialLocation: RouteConstants.splashPath,
    routes: [
      GoRoute(
        name: RouteConstants.splash,
        path: RouteConstants.splashPath,
        builder: (context, state) => const SplashPage(),
      ),

      GoRoute(
        name: RouteConstants.login,
        path: RouteConstants.loginPath,
        builder: (context, state) => const LoginPage(),
      ),

      GoRoute(
        name: RouteConstants.root,
        path: RouteConstants.rootPath,
        builder: (context, state) {
          final tabIndex =
              int.tryParse(state.pathParameters['root_tab'] ?? '') ?? 0;
          final tab = RootTab.fromIndex(tabIndex);

          if (tab == RootTab.presensi) {
            return const Presensi();
          }

          if (tab == RootTab.checkout) {
            return const Checkout();
          }

          if (tab == RootTab.history) {
            return const HistoryPage();
          }

          if (tab == RootTab.profile) {
            return const Profile();
          }

          return Homepage(
            key: state.pageKey,
            currentTab: tab,
          );
        },
      ),

      // Presensi Route
      GoRoute(
        name: RouteConstants.presensi,
        path: RouteConstants.presensiPath,
        builder: (context, state) => const Presensi(),
      ),

      // Checkout Route
      GoRoute(
        name: RouteConstants.checkout,
        path: RouteConstants.checkoutPath,
        builder: (context, state) => const Checkout(),
      ),
    ],
  );
}
