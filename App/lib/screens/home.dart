import 'package:flutter/material.dart';
import 'package:first_flatter_app/repository/werte_repository.dart';
import 'package:first_flatter_app/Models/Werte.dart';


class Home extends StatefulWidget{
  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home>{
  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(
      centerTitle: true,
      title: Text('Liste'),
    ),
  );
}