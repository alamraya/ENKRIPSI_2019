import 'package:flutter/material.dart';

class About extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        title: Text("Tentang Kami", style: TextStyle(color: Colors.black)),
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
                  Container(height: 20.0),
                  Text("""Crypsi dikembangkan dalam rangka memenuhi tugas keamanan informasi pada tugas cryptography oleh \n\n1. Herman Sugiharto (177006045), \n2. Aldi Noor Septandy (177006001), \n3. Fahmi Ahmad Fauzi (177006048),\n4. Doni Agistira (177006075).
                  """),
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
