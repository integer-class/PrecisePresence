import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

import '../../presentation/intro/splash_page.dart';

part 'route_constants.dart';
part 'enums/root_tab.dart';
part 'models/path_parameters.dart';

class AppRouter {
  final router = GoRouter(
    initialLocation: RouteConstants.splashPath,
    routes: [
      GoRoute(
        name: RouteConstants.splash,
        path: RouteConstants.splashPath,
        builder: (context, state) => const SplashPage(),
      ),
      // GoRoute(
      //   name: RouteConstants.login,
      //   path: RouteConstants.loginPath,
      //   // builder: (context, state) => const LoginPage(),
      // ),
      // GoRoute(
      //   name: RouteConstants.root,
      //   path: RouteConstants.rootPath,
      //   builder: (context, state) {
      //     final tab = int.tryParse(state.pathParameters['root_tab'] ?? '') ?? 0;
      //     return DashboardPage(
      //       key: state.pageKey,
      //       currentTab: tab,
      //     );
      //   },
      //   routes: [
      //     GoRoute(
      //       name: RouteConstants.orderList,
      //       path: RouteConstants.orderListPath,
      //       builder: (context, state) => const HistoryOrderPage(),
      //     ),
      //     GoRoute(
      //       name: RouteConstants.cart,
      //       path: RouteConstants.cartPath,
      //       builder: (context, state) => const CartPage(),
      //       routes: [
      //         GoRoute(
      //           name: RouteConstants.orderDetail,
      //           path: RouteConstants.orderDetailPath,
      //           builder: (context, state) => const OrderDetailPage(),
      //           routes: [
      //             GoRoute(
      //               name: RouteConstants.paymentDetail,
      //               path: RouteConstants.paymentDetailPath,
      //               builder: (context, state) => const PaymentDetailPage(),
      //               routes: [
      //                 GoRoute(
      //                   name: RouteConstants.paymentWaiting,
      //                   path: RouteConstants.paymentWaitingPath,
      //                   builder: (context, state) {
      //                     final args = state.extra as int;
      //                     return PaymentWaitingPage(orderId: args);
      //                   },
      //                 ),
      //                 GoRoute(
      //                   name: RouteConstants.trackingOrder,
      //                   path: RouteConstants.trackingOrderPath,
      //                   builder: (context, state) {
      //                     final args = state.extra as int;
      //                     return TrackingOrderPage(orderId: args);
      //                   },
      //                   routes: [
      //                     GoRoute(
      //                       name: RouteConstants.shippingDetail,
      //                       path: RouteConstants.shippingDetailPath,
      //                       builder: (context, state) {
      //                         final args = state.extra as String;
      //                         return ShippingDetailPage(resi: args);
      //                       },
      //                     ),
      //                   ],
      //                 ),
      //               ],
      //             ),
      //           ],

      //           // routes: [
      //           //   GoRoute(
      //           //     name: RouteConstants.paymentDetail,
      //           //     path: RouteConstants.paymentDetailPath,
      //           //     builder: (context, state) => const PaymentDetailPage(),
      //           //     routes: [
      //           //       GoRoute(
      //           //         name: RouteConstants.trackingOrder,
      //           //         path: RouteConstants.trackingOrderPath,
      //           //         builder: (context, state) => const TrackingOrderPage(),
      //           //         routes: [
      //           //           GoRoute(
      //           //             name: RouteConstants.shippingDetail,
      //           //             path: RouteConstants.shippingDetailPath,
      //           //             builder: (context, state) =>
      //           //                 const ShippingDetailPage(),
      //           //           ),
      //           //         ],
      //           //       ),
      //           //     ],
      //           //   ),
      //           // ],
      //         ),
      //       ],
      //     ),
      //     GoRoute(
      //         name: RouteConstants.address,
      //         path: RouteConstants.addressPath,
      //         builder: (context, state) => const AddressPage(),
      //         routes: [
      //           GoRoute(
      //             name: RouteConstants.addAddress,
      //             path: RouteConstants.addAddressPath,
      //             builder: (context, state) => const AddAddressPage(),
      //           ),
      //           GoRoute(
      //             name: RouteConstants.editAddress,
      //             path: RouteConstants.editAddressPath,
      //             builder: (context, state) {
      //               final args = state.extra as AddressModel;
      //               return EditAddressPage(data: args);
      //             },
      //           ),
      //         ]),
      //   ],
      // ),
      //   routes: [
      //     GoRoute(
      //       name: RouteConstants.productDetail,
      //       path: RouteConstants.productDetailPath,
      //       builder: (context, state) {
      //         final args = state.extra as ProductModel;
      //         return ProductDetailPage(data: args);
      //       },
      //     ),
      //     GoRoute(
      //       name: RouteConstants.cart,
      //       path: RouteConstants.cartPath,
      //       builder: (context, state) => const CartPage(),
      //     ),
      //     GoRoute(
      //       name: RouteConstants.address,
      //       path: RouteConstants.addressPath,
      //       builder: (context, state) => const AddressPage(),
      //       routes: [
      //         GoRoute(
      //           name: RouteConstants.addAddress,
      //           path: RouteConstants.addAddressPath,
      //           builder: (context, state) => const AddAddressPage(),
      //         ),
      //         GoRoute(
      //           name: RouteConstants.editAddress,
      //           path: RouteConstants.editAddressPath,
      //           builder: (context, state) {
      //             final args = state.extra as AddressModel;
      //             return EditAddressPage(data: args);
      //           },
      //         ),
      //         GoRoute(
      //           name: RouteConstants.orderDetail,
      //           path: RouteConstants.orderDetailPath,
      //           builder: (context, state) => const OrderDetailPage(),
      //           routes: [
      //             GoRoute(
      //               name: RouteConstants.paymentDetail,
      //               path: RouteConstants.paymentDetailPath,
      //               builder: (context, state) => const PaymentDetailPage(),
      //               routes: [
      //                 GoRoute(
      //                   name: RouteConstants.trackingOrder,
      //                   path: RouteConstants.trackingOrderPath,
      //                   builder: (context, state) => const TrackingOrderPage(),
      //                   routes: [
      //                     GoRoute(
      //                       name: RouteConstants.shippingDetail,
      //                       path: RouteConstants.shippingDetailPath,
      //                       builder: (context, state) =>
      //                           const ShippingDetailPage(),
      //                     ),
      //                   ],
      //                 ),
      //               ],
      //             ),
      //           ],
      //         ),
      //       ],
      //     ),
      //   ],
      // ),
    ],
    errorPageBuilder: (context, state) {
      return MaterialPage(
        key: state.pageKey,
        child: Scaffold(
          body: Center(
            child: Text(
              state.error.toString(),
              textAlign: TextAlign.center,
            ),
          ),
        ),
      );
    },
  );
}
