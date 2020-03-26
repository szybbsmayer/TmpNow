import 'package:flutter/material.dart';
import 'package:first_flatter_app/screens/home.dart';

class ListApp extends StatelessWidget{
  Widget build(BuildContext context)=> MaterialApp(
    title: 'Liste',
    debugShowCheckedModeBanner: false,
    theme: ThemeData(
        primaryColor: Colors.black,
        accentColor: Colors.black
    ),
    home: Home(),
  );
}
