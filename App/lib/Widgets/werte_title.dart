import 'package:flutter/material.dart';
import '../models/Werte.dart';

class WerteTile extends StatelessWidget {
  final Werte _werte;
  WerteTile(this._Werte);

  @override
  Widget build(BuildContext context) => Column(
    children: <Widget>[
      ListTile(
        title: Text(_werte.),
        subtitle: Text(_werte.),
        leading: Container(
            margin: EdgeInsets.only(left: 6.0),
            child: Image.network(_beer.image_url, height: 50.0, fit: BoxFit.fill,)
        ),
      ),
      Divider()
    ],
  );
}