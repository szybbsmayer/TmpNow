import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:first_flatter_app/models/werte.dart';

Future<Stream<Werte>> getWerte() async{
  final String url='https://github.com/szybbsmayer/TmpNow/blob/master/Backend/src/index.php';

  final client = new http.Client();
  final streamedRest = await client.send(
    http.Request('get', Uri.parse(url))
  );

  return streamedRest.stream
      .transform(utf8.decoder)
      .transform(json.decoder)
      .expand((data)=>(data as List))
      .map((data) => Werte.fromJson(data));
}