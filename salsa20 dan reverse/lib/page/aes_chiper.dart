import 'package:encrypt/encrypt.dart' as prefix0;
import 'package:flutter/material.dart';
import 'info.dart';
import 'package:encrypt/encrypt.dart';
import 'package:flutter/services.dart';
import 'package:random_string/random_string.dart';

class AesCipher extends StatefulWidget {
  @override
  _AesCipherState createState() => _AesCipherState();
}

class _AesCipherState extends State<AesCipher> {
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
    final encrypter = Encrypter(AES(key));

    final encrypted = encrypter.encrypt(plainText, iv: iv);
    print(encrypted);
    return (encrypted.base64);
  }

  String dekript(text) {
    final plainText = text;
    final key = prefix0.Key.fromUtf8(keytext.text);
    final iv = IV.fromUtf8(vitext.text);
    final encrypter = Encrypter(AES(key));
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
          title: Text("AES", style: TextStyle(color: Colors.black)),
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
                          title: 'AES',
                          jenis: 'Algoritma Modern',
                          isi:
                          'Dalam kriptografi, Standar Enkripsi Lanjutan (Advanced Encryption Standard, AES) merupakan standar enkripsi dengan kunci-simetris yang diadopsi oleh pemerintah Amerika Serikat. Standar ini terdiri atas 3 blok cipher, yaitu AES-128, AES-192 and AES-256, yang diadopsi dari koleksi yang lebih besar yang awalnya diterbitkan sebagai Rijndael. Masing-masing cipher memiliki ukuran 128-bit, dengan ukuran kunci masing-masing 128, 192, dan 256 bit. AES telah dianalisis secara luas dan sekarang digunakan di seluruh dunia, seperti halnya dengan pendahulunya, Data Encryption Standard (DES).'
                          '\n\nAES diumumkan oleh Institut Nasional Standar dan Teknologi (NIST) sebagai Standar Pemrosesan Informasi Federal (FIPS) publikasi 197 (FIPS 197) pada tanggal 26 November 2001 setelah proses standardisasi selama 5 tahun, di mana ada 15 desain enkripsi yang disajikan dan dievaluasi, sebelum Rijndael terpilih sebagai yang paling cocok. AES efektif menjadi standar pemerintah Federal pada tanggal 26 Mei 2002 setelah persetujuan dari Menteri Perdagangan. AES tersedia dalam berbagai paket enkripsi yang berbeda. AES merupakan standar yang pertama yang dapat diakses publik dan sandi-terbuka yang disetujui oleh NSA untuk informasi rahasia.')),
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
