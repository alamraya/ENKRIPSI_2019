import 'package:encrypt/encrypt.dart' as prefix0;
import 'package:flutter/material.dart';
import 'info.dart';
import 'package:encrypt/encrypt.dart';
import 'package:flutter/services.dart';
import 'package:random_string/random_string.dart';

class Salsa extends StatefulWidget {
  @override
  _SalsaState createState() => _SalsaState();
}

class _SalsaState extends State<Salsa> {
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
    final encrypter = Encrypter(Salsa20(key));

    final encrypted = encrypter.encrypt(plainText, iv: iv);
    print(encrypted);
    return (encrypted.base64);
  }

  String dekript(text) {
    final plainText = text;
    final key = prefix0.Key.fromUtf8(keytext.text);
    final iv = IV.fromUtf8(vitext.text);
    final encrypter = Encrypter(Salsa20(key));
    final encrypted = encrypter.decrypt64(plainText, iv: iv);
    return (encrypted);
  }

  @override
  Widget build(BuildContext context) {
    return new DefaultTabController(
      length: 2,
      child: Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          title: Text("Salsa20", style: TextStyle(color: Colors.black)),
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
                          title: 'Salsa20',
                          jenis: 'Algoritma Modern',
                          isi:
                              'Salsa20 dan ChaCha yang terkait erat adalah stream cipher yang dikembangkan oleh Daniel J. Bernstein .'
                          'Karena kedua sandi sangat mirip, artikel ini kadang-kadang akan membahasnya bersama. Salsa20, cipher asli, dirancang pada 2005, lalu diserahkan ke eSTREAM oleh Daniel J. Bernstein . ChaCha adalah modifikasi dari Salsa20 yang diterbitkan oleh Bernstein pada tahun 2008. ChaCha menggunakan fungsi putaran baru yang meningkatkan difusi dan meningkatkan kinerja pada beberapa arsitektur.'
                          '\n\nKedua cipher dibangun pada fungsi pseudorandom berdasarkan operasi add-rotate-xor (ARX) - penambahan 32-bit, penambahan bitwise (XOR) dan operasi rotasi . Fungsi inti memetakan sebuah 256- bit kunci , 64-bit Nonce , dan 64-bit counter ke blok 512-bit dari aliran kunci (versi Salsa dengan kunci 128-bit juga ada). Ini memberikan Salsa20 dan ChaCha keuntungan yang tidak biasa bahwa pengguna dapat secara efisien mencari posisi apa pun di aliran utama dalam waktu yang konstan. Salsa20 menawarkan kecepatan sekitar 4–14 siklus per byte dalam perangkat lunak pada prosesor x86 modern , dan kinerja perangkat keras yang wajar. Itu tidak dipatenkan, dan Bernstein telah menulis beberapa implementasi domain publik yang dioptimalkan untuk arsitektur umum.')),
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
                                      } else if (value.length != 16){
                                        return 'Kunci harus 16 karakter';
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
                                      } else if (value.length != 16){
                                        return 'Kunci harus 16 karakter';
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
