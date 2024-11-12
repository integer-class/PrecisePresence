import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:precisepresence/screens/history/history.dart';
import 'package:precisepresence/screens/home/home.dart';
import 'package:precisepresence/screens/intro/splash_page.dart';
import 'package:precisepresence/screens/auth/login.dart';
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

          if (tab == RootTab.history) {
            return const HistoryPage();
          }

          return Homepage(
            key: state.pageKey,
            currentTab: tab,
          );
        },
      )
    ],
  );
}
