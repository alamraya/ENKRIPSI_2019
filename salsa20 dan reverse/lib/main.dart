import 'package:crypsi/page/aes_chiper.dart';
import './page/about.dart';
import 'package:flutter/material.dart';
import './page/reverse_cipher.dart';
import './page/sasa.dart';
import './page/fernet.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Crypsi',
      debugShowCheckedModeBanner: false,
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(80.0),
        child: AppBar(

          automaticallyImplyLeading: false, // hides leading widget
          flexibleSpace: Padding(
            padding: EdgeInsets.only(top: 50, left: 20.0, right: 20.0),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: <Widget>[
                Text(
                  "Crypsi",
                  style: TextStyle(
                      color: Colors.black87, fontSize: 30, fontWeight: FontWeight.bold),
                ),
                IconButton(
                  icon: Icon(Icons.info_outline, color: Colors.pink,),
                  onPressed: (){
                Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => About()),
                );
                },
                ),
              ]
            ),
          ),

          elevation: 0,
          backgroundColor: Colors.white,
        ),
      ),
      body: Container(
        width: MediaQuery.of(context).size.width,
        height: MediaQuery.of(context).size.height,
        color: Colors.white,
        child: Padding(
          padding: const EdgeInsets.only(left: 20.0, right: 20.0, top: 20.0),
          child: ListView(
            physics: ScrollPhysics(),
            shrinkWrap: true,
            children: <Widget>[
              Text(
                "Classic",
                style: TextStyle(
                    color: Colors.black87.withOpacity(0.8),
                    fontWeight: FontWeight.bold,
                    fontSize: 16.0),
              ),
              Container(
                height: 20.0,
              ),
              Container(
                width: MediaQuery.of(context).size.width,
                height: 100.0,
                child: GridView.count(
                  physics: new NeverScrollableScrollPhysics(),
                  primary: true,
                  crossAxisCount: 2,
                  shrinkWrap: true,
                  childAspectRatio: 16/6,
                  crossAxisSpacing: 10.0,
                  mainAxisSpacing: 10.0,
                  children: <Widget>[
                    RaisedButton.icon(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => ReverseCipher()),
                          );
                        },
                        icon: Icon(Icons.enhanced_encryption, color: Colors.white),
                        color: Colors.black87,
                        splashColor: Colors.pink,
                        label: Text("Reverse \nChiper", style: TextStyle(color: Colors.white),softWrap: true,)),
                  ],
                ),
              ),
              Container(width: MediaQuery.of(context).size.width, height: 2.0,color: Colors.black87.withOpacity(0.2), margin: EdgeInsets.only(bottom: 20.0),),
              Text(
                "Modern",
                style: TextStyle(
                    color: Colors.black87.withOpacity(0.8),
                    fontWeight: FontWeight.bold,
                    fontSize: 16.0),
              ),
              Container(
                height: 20.0,
              ),
              Container(
                width: MediaQuery.of(context).size.width,
                height: 150.0,
                child: GridView.count(
                  physics: new NeverScrollableScrollPhysics(),
                  primary: true,
                  crossAxisCount: 2,
                  shrinkWrap: true,
                  childAspectRatio: 16/6,
                  crossAxisSpacing: 10.0,
                  mainAxisSpacing: 10.0,
                  children: <Widget>[
                    RaisedButton.icon(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => Salsa()),
                          );
                        },
                        icon: Icon(Icons.lock_outline, color: Colors.white),
                        color: Colors.black87,
                        splashColor: Colors.pink,
                        label: Text("Salsa20", style: TextStyle(color: Colors.white),softWrap: true,)),
                    RaisedButton.icon(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => AesCipher()),
                          );
                        },
                        icon: Icon(Icons.lock_outline, color: Colors.white),
                        color: Colors.black87,
                        splashColor: Colors.pink,
                        label: Text("AES", style: TextStyle(color: Colors.white),softWrap: true,)),
                    RaisedButton.icon(
                        onPressed: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(builder: (context) => FernetCipher()),
                          );
                        },
                        icon: Icon(Icons.lock_outline, color: Colors.white),
                        color: Colors.black87,
                        splashColor: Colors.pink,
                        label: Text("Fernet", style: TextStyle(color: Colors.white),softWrap: true,)),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
