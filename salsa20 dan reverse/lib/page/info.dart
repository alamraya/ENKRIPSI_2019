import 'package:flutter/material.dart';

class InfoScreen extends StatelessWidget {
  final String title;
  final String isi;
  final String jenis;
  final String wiki;

  const InfoScreen({Key key, this.title, this.jenis, this.isi, this.wiki}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          title: Text(title, style: TextStyle(color: Colors.black)),
          centerTitle: true,
          backgroundColor: Colors.white,
          iconTheme: IconThemeData(color: Colors.black),
          elevation: 0,
        ),
      body: Container(
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.height,
        child: ListView(
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.all(20.0),
              child: Column(
                children: <Widget>[
                  Container(
                    decoration: BoxDecoration(
                      color: Colors.grey.withOpacity(0.7),
                      borderRadius: BorderRadius.all(Radius.circular(100.0))
                    ),

                    child: Padding(
                      padding: const EdgeInsets.all(12.0),
                      child: Text(jenis),
                    ),
                  ),
                  Container(height: 20.0),
                  Text(isi),
                  Container(height: 20.0,),

                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}
