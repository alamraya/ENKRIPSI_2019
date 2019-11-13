import 'package:encrypt/encrypt.dart' as prefix0;
import 'package:flutter/material.dart';
import 'info.dart';
import 'package:encrypt/encrypt.dart';
import 'package:flutter/services.dart';
import 'dart:convert';
import 'package:random_string/random_string.dart';

class FernetCipher extends StatefulWidget {
  @override
  _FernetCipherState createState() => _FernetCipherState();
}

class _FernetCipherState extends State<FernetCipher> {
  var encrypt = TextEditingController();
  var decrypt = '';
  var keytext = TextEditingController();
  var vitext = TextEditingController();
  final _formKey = GlobalKey<FormState>();
  final _formKey2 = GlobalKey<FormState>();

  String enkripsi(text) {
    final plainText = text;
    final key = prefix0.Key.fromUtf8(keytext.text);
    final iv = IV.fromUtf8(vitext.text);
    final b64key = prefix0.Key.fromUtf8(base64Url.encode(key.bytes));
    final fernet = Fernet(b64key);
    final encrypter = Encrypter(fernet);

    final encrypted = encrypter.encrypt(plainText);
    print(encrypted);
    return (encrypted.base64);
  }

  String dekript(text) {
    final plainText = text;
    final key = prefix0.Key.fromUtf8(keytext.text);
    final iv = IV.fromUtf8(vitext.text);
    final b64key = prefix0.Key.fromUtf8(base64Url.encode(key.bytes));
    final fernet = Fernet(b64key);
    final encrypter = Encrypter(fernet);

    final encrypted = encrypter.decrypt64(plainText);
    return (encrypted);
  }

  @override
  Widget build(BuildContext context) {
    return new DefaultTabController(
      length: 2,
      child: Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          title: Text("Fernet", style: TextStyle(color: Colors.black)),
          backgroundColor: Colors.white,
          iconTheme: IconThemeData(color: Colors.black),
          bottom: new TabBar(
            onTap: (tab) {
              decrypt = '';
              print(decrypt);
            },
            tabs: <Widget>[
              new Tab(
                  child: Text("Encryption",
                      style: TextStyle(color: Colors.black))),
              new Tab(
                  child: Text("Decryption",
                      style: TextStyle(color: Colors.black))),
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
                          title: 'Fernet',
                          jenis: 'Algoritma Modern',
                          isi:
                          'Fernet menjamin bahwa pesan yang dienkripsi menggunakannya tidak dapat dimanipulasi atau dibaca tanpa kunci. Fernet adalah implementasi kriptografi terotentikasi simetris (juga dikenal sebagai "kunci rahasia"). Fernet juga memiliki dukungan untuk mengimplementasikan rotasi tombol melalui MultiFernet')),
                );
              },
            )
          ],
        ),
        body: new TabBarView(
          children: <Widget>[
            new Container(
                child: ListView(
                  children: <Widget>[
                    Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            TextFormField(

                              validator: (value) {
                                if (value.isEmpty) {
                                  return 'Masukan teks';
                                }
                                return null;
                              },
                              controller: encrypt,

                              decoration: InputDecoration(
                                  labelText: 'teks biasa',
                                  hintText: 'Masukkan kata enkripsi'
                              ),
                            ),
                            Row(
                              children: <Widget>[
                                Container(
                                  width: MediaQuery.of(context).size.width*0.6,
                                  child: TextFormField(

                                    validator: (value) {
                                      if (value.isEmpty) {
                                        return 'Masukkan Kunci';
                                      } else if (value.length != 32){
                                        return 'Kunci harus 32 karakter';
                                      }
                                      return null;
                                    },
                                    controller: keytext,
                                    decoration: InputDecoration(
                                        labelText: 'Kunci',
                                        hintText: 'Kunci'
                                    ),
                                  ),
                                ),
                                RaisedButton(
                                  onPressed: () {
                                    keytext.text = randomAlphaNumeric(32);
                                  },
                                  color: Colors.pink,
                                  elevation: 5,

                                  child: Text('random', style: TextStyle(color: Colors.white)),
                                ),
                              ],
                            ),
                            Row(
                              children: <Widget>[
                                Container(
                                  width: MediaQuery.of(context).size.width*0.6,
                                  child: TextFormField(

                                    validator: (value) {
                                      if (value.isEmpty) {
                                        return 'Masukkan Initialitation Vector';
                                      } else if (value.length != 8){
                                        return 'Kunci harus 8 karakter';
                                      }
                                      return null;
                                    },
                                    controller: vitext,
                                    decoration: InputDecoration(
                                        labelText: 'Initialitation Vector',
                                        hintText: 'Initialitation Vector'
                                    ),
                                  ),
                                ),
                                RaisedButton(
                                  onPressed: () {
                                    vitext.text = randomAlphaNumeric(8);
                                  },
                                  color: Colors.pink,
                                  elevation: 5,

                                  child: Text('random', style: TextStyle(color: Colors.white)),
                                ),
                              ],
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(vertical: 16.0),
                              child: RaisedButton(
                                onPressed: () {
                                  if (_formKey.currentState.validate()) {
                                    _formKey.currentState.save();
                                    decrypt = enkripsi(encrypt.text);
                                  }
                                },
                                child: Text('Submit'),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    decrypt.length > 0
                        ? Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Container(
                        decoration: BoxDecoration(
                            color: Colors.grey.withOpacity(0.3),
                            borderRadius:
                            BorderRadius.all(Radius.circular(10.0))),
                        width: MediaQuery.of(context).size.width,
                        child: Padding(
                          padding: const EdgeInsets.all(20.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text('hasil : '),
                              Text(
                                decrypt,
                                style: TextStyle(fontSize: 18.0),
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.end,
                                children: <Widget>[
                                  IconButton(
                                      icon: Icon(Icons.content_copy),
                                      onPressed: () {
                                        Clipboard.setData(
                                            new ClipboardData(text: decrypt));
                                      })
                                ],
                              )
                            ],
                          ),
                        ),
                      ),
                    )
                        : Container(),
                  ],
                )),
            new Container(
                child: ListView(
                  children: <Widget>[
                    Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            TextFormField(

                              validator: (value) {
                                if (value.isEmpty) {
                                  return 'Masukan teks';
                                }
                                return null;
                              },
                              controller: encrypt,
                              decoration: InputDecoration(
                                  labelText: 'teks enkripsi',
                                  hintText: 'Masukkan kata yang sudah di enkripsi'
                              ),
                            ),
                            Row(
                              children: <Widget>[
                                Container(
                                  width: MediaQuery.of(context).size.width*0.6,
                                  child: TextFormField(

                                    validator: (value) {
                                      if (value.isEmpty) {
                                        return 'Masukkan Kunci';
                                      } else if (value.length != 32){
                                        return 'Kunci harus 32 karakter';
                                      }
                                      return null;
                                    },
                                    controller: keytext,
                                    decoration: InputDecoration(
                                        labelText: 'Kunci',
                                        hintText: 'Kunci'
                                    ),
                                  ),
                                ),
                                RaisedButton(
                                  onPressed: () {
                                    keytext.text = randomAlphaNumeric(16);
                                  },
                                  color: Colors.pink,
                                  elevation: 5,

                                  child: Text('random', style: TextStyle(color: Colors.white)),
                                ),
                              ],
                            ),
                            Row(
                              children: <Widget>[
                                Container(
                                  width: MediaQuery.of(context).size.width*0.6,
                                  child: TextFormField(

                                    validator: (value) {
                                      if (value.isEmpty) {
                                        return 'Masukkan Initialitation Vector';
                                      } else if (value.length != 8){
                                        return 'Kunci harus 8 karakter';
                                      }
                                      return null;
                                    },
                                    controller: vitext,
                                    decoration: InputDecoration(
                                        labelText: 'Initialitation Vector',
                                        hintText: 'Initialitation Vector'
                                    ),
                                  ),
                                ),
                                RaisedButton(
                                  onPressed: () {
                                    vitext.text = randomAlphaNumeric(8);
                                  },
                                  color: Colors.pink,
                                  elevation: 5,

                                  child: Text('random', style: TextStyle(color: Colors.white)),
                                ),
                              ],
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(vertical: 16.0),
                              child: RaisedButton(
                                onPressed: () {
                                  if (_formKey.currentState.validate()) {
                                    _formKey.currentState.save();
                                    decrypt = dekript(encrypt.text);
                                  }
                                },
                                child: Text('Submit'),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    decrypt.length > 0
                        ? Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Container(
                        decoration: BoxDecoration(
                            color: Colors.grey.withOpacity(0.3),
                            borderRadius:
                            BorderRadius.all(Radius.circular(10.0))),
                        width: MediaQuery.of(context).size.width,
                        child: Padding(
                          padding: const EdgeInsets.all(20.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text('hasil : '),
                              Text(
                                decrypt,
                                style: TextStyle(fontSize: 18.0),
                              ),
                              Row(
                                mainAxisAlignment: MainAxisAlignment.end,
                                children: <Widget>[
                                  IconButton(
                                      icon: Icon(Icons.content_copy),
                                      onPressed: () {
                                        Clipboard.setData(
                                            new ClipboardData(text: decrypt));
                                      })
                                ],
                              )
                            ],
                          ),
                        ),
                      ),
                    )
                        : Container(),
                  ],
                )),
          ],
        ),
      ),
    );
  }
}
