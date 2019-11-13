import 'package:flutter/material.dart';
import 'info.dart';
import 'package:flutter/services.dart';

class ReverseCipher extends StatefulWidget {
  @override
  _ReverseCipherState createState() => _ReverseCipherState();
}

class _ReverseCipherState extends State<ReverseCipher> {
  String encrypt = '';
  String decrypt = '';
  @override
  Widget build(BuildContext context) {
    return new DefaultTabController(
        length: 2,

      child: Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          title: Text("Reverse Cipher", style: TextStyle(color: Colors.black)),
          backgroundColor: Colors.white,
          iconTheme: IconThemeData(color: Colors.black),
          bottom: new TabBar(
            onTap: (tab){
              decrypt = '';
              print(decrypt);
            },
            tabs: <Widget>[
              new Tab(
                child: Text("Encryption", style: TextStyle(color: Colors.black))
              ),
              new Tab(
                  child: Text("Decryption", style: TextStyle(color: Colors.black))
              ),
            ],
          ),
          actions: <Widget>[
            IconButton(
              icon: Icon(Icons.help_outline, color: Colors.pink),
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) => InfoScreen(
                          title: 'Reverse Cipher',
                          jenis: 'Algoritma Klasik',
                          isi:
                              'Reverse Cipher adalah contoh kriptografi klasik yang menggunakan '
                                  'substitusi yaitu mengganti satu huruf dengan  huruf  lain ataupun mengubah suatu kalimat dengan menuliskan setiap kata secara terbalik. Ini contoh yang '
                                  'paling sederhana dari transposisi yaitu mengubah suatu kalimat dengan menuliskan setiap kata secara terbalik.')),
                );
              },
            )
          ],
        ),
        body: new TabBarView(
          children: <Widget>[
            new Container(
              child: Column(
                children: <Widget>[
                  Padding(
                    padding: const EdgeInsets.all(20.0),
                    child: TextField(
                      decoration: InputDecoration(
                        hintText: 'Masukan kata untuk dienkripsi'
                      ),
                      maxLines: 1,
                      onChanged: (text) {
                        String trans = '';
                        int i = text.length - 1;
                        while(i >= 0){
                          trans = trans + text[i];
                          i = i - 1;
                        }
                        decrypt = trans;
                        print(decrypt.length);
                      },
                    ),
                  ),
                  decrypt.length > 0 ? Padding(
                    padding: const EdgeInsets.all(20.0),
                    child: Container(
                      decoration: BoxDecoration(
                          color: Colors.grey.withOpacity(0.3),
                          borderRadius: BorderRadius.all(Radius.circular(10.0))
                      ),
                      width: MediaQuery.of(context).size.width,
                      child: Padding(
                        padding: const EdgeInsets.all(20.0),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            Text('hasil : '),
                            Text(decrypt, style: TextStyle(fontSize: 18.0),),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.end,
                              children: <Widget>[
                                IconButton(icon: Icon(Icons.content_copy), onPressed: (){
                                  Clipboard.setData(new ClipboardData(text: decrypt));
                                })
                              ],
                            )
                          ],
                        ),
                      ),
                    ),
                  ): Container(),

                ],
              )
            ),
            new Container(
                child: Column(
                  children: <Widget>[
                    Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: TextField(
                        decoration: InputDecoration(
                            hintText: 'Masukan kata untuk didecrypt'
                        ),
                        maxLines: 1,
                        onChanged: (text) {
                          String trans = '';
                          int i = text.length - 1;
                          while(i >= 0){
                            trans = trans + text[i];
                            i = i - 1;
                          }
                          decrypt = trans;
                        },
                      ),
                    ),
                    decrypt.length > 0 ? Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Container(
                        decoration: BoxDecoration(
                            color: Colors.grey.withOpacity(0.3),
                            borderRadius: BorderRadius.all(Radius.circular(10.0))
                        ),
                        width: MediaQuery.of(context).size.width,
                        child: Padding(
                          padding: const EdgeInsets.all(20.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text('hasil : '),
                              Text(decrypt, style: TextStyle(fontSize: 18.0),),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.end,
                                children: <Widget>[
                                  IconButton(icon: Icon(Icons.content_copy), onPressed: (){
                                    Clipboard.setData(new ClipboardData(text: decrypt));
                                  })
                                ],
                              )
                            ],
                          ),
                        ),
                      ),
                    ): Container(),

                  ],
                )
            ),
          ],
      ),
      ),
    );
  }
}
