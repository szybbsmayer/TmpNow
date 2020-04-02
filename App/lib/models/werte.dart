class Werte{
  final int id;
  final String date;
  final String device;
  final String humidity;
  final String temp;
  final String pressure;

  Werte.fromJson(Map<String, dynamic> jsonMap) :
        id = jsonMap['id'],
        date = jsonMap['date'],
        device = jsonMap['tagline'],
        humidity = jsonMap['humidity'],
        temp = jsonMap['temp'],
        pressure = jsonMap['pressure'];
}