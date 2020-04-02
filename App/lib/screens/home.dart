import 'package:flutter/material.dart';
import 'package:first_flatter_app/repository/werte_repository.dart';
import 'package:first_flatter_app/models/werte.dart';
import 'package:first_flatter_app/Widgets/werte_title.dart';


class Home extends StatefulWidget{
  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home>{
  List<Werte> _werte = <Werte>[];

  @override
  void initState(){
    super.initState();
    listenForWerte();
  }



  Widget build(BuildContext context) => Scaffold(
    appBar: AppBar(
      centerTitle: true,
      title: Text('Liste'),
    ),
    body: ListView.builder(
      itemCount: _werte.length,
      itemBuilder: (context, index)=> WerteTile(_werte[index]),
    ),
  );

  void listenForWerte() async{
    final Stream<Werte> stream = await getWerte();
    stream.listen((Werte werte) =>
      setState(() => _werte.add(werte))
    );
  }
}