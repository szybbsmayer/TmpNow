import 'package:flutter/material.dart';
import 'package:first_flatter_app/models/werte.dart';

class WerteTile extends StatelessWidget {
  final Werte _werte;
  WerteTile(this._werte);

  @override
  Widget build(BuildContext context) => Column(
    children: <Widget>[
      ListTile(
        title: Text('Werte Nr.'+_werte.id.toString()),
        subtitle: Text('Temperatur:'+_werte.temp+'Luftdruck:'+ _werte.pressure+'Luftfeuchtigkeit:'+ _werte.humidity),
        //subtitle: Text('Gerät' +_werte.device +'Datum'+_werte.date),

      ),
      Divider()
    ],
  );
}