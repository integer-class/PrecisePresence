import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:precisepresence/core/router/app_router.dart';
import 'package:precisepresence/presentation/auth/bloc/login_bloc.dart';

import 'core/constants/colors.dart';
import 'package:google_fonts/google_fonts.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    final appRouter = AppRouter();
    final router = appRouter.router;
    return MultiBlocProvider(
      providers: [
        // BlocProvider(
        //   create: (context) => CategoryBloc(CategoryRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => AllProductBloc(ProductRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => BestSellerProductBloc(ProductRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) =>
        //       SpecialOfferProductBloc(ProductRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => CheckoutBloc(),
        // ),
        BlocProvider(create: (context) => LoginBloc(AuthRemoteDatasource())),
        // BlocProvider(
        //   create: (context) => LogoutBloc(AuthRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => AddressBloc(AddressRemoteDataSource()),
        // ),
        // BlocProvider(
        //   create: (context) => AddAddressBloc(AddressRemoteDataSource()),
        // ),
        // BlocProvider(
        //   create: (context) => ProvinceBloc(RajaongkirRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => CityBloc(RajaongkirRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => SubdistrictBloc(RajaongkirRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => CostBloc(RajaongkirRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => TrackingBloc(RajaongkirRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => OrderBloc(OrderRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => StatusOrderBloc(OrderRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => HistoryOrderBloc(OrderRemoteDatasource()),
        // ),
        // BlocProvider(
        //   create: (context) => OrderDetailBloc(OrderRemoteDatasource()),
        // ),
      ],
      child: MaterialApp.router(
        debugShowCheckedModeBanner: false,
        title: 'Flutter Demo',
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: AppColors.primary),
          textTheme: GoogleFonts.dmSansTextTheme(
            Theme.of(context).textTheme,
          ),
          appBarTheme: AppBarTheme(
            color: AppColors.white,
            titleTextStyle: GoogleFonts.quicksand(
              color: AppColors.primary,
              fontSize: 18.0,
              fontWeight: FontWeight.w700,
            ),
            iconTheme: const IconThemeData(
              color: AppColors.black,
            ),
            centerTitle: true,
            shape: Border(
              bottom: BorderSide(
                color: AppColors.black.withOpacity(0.05),
              ),
            ),
          ),
        ),
        routerDelegate: router.routerDelegate,
        routeInformationParser: router.routeInformationParser,
        routeInformationProvider: router.routeInformationProvider,
      ),
    );
  }
}
