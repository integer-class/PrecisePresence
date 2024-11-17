import 'package:dartz/dartz.dart';
import 'package:http/http.dart' as http;
import 'package:precisepresence/constants/variables.dart';
import 'package:precisepresence/data/responses/history_response_model.dart';

class HistoryRemoteDatasource {
  Future<Either<String, HistoryResponseModel>> getHistory() async {
    final url = Uri.parse('$baseUrl/history');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      return Right(HistoryResponseModel.fromJson(response.body));
    } else {
      return Left('Failed to get history: ${response.body}');
    }
  }
}
