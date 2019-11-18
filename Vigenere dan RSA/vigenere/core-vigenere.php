<?php
class Vigenere{
    private $cipher, $plaintext, $key, $pt, $cp;
    //Array untuk menentukkan nilai setiap karakter
    private $alpha = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    //Function untuk enkripsi
    public function encrypt($pt, $key){
        $this->pt = strtoupper($pt);
        $this->key = strtoupper($key);
        //Membuat key
        if(strlen($this->key) < strlen($this->pt)){
            $kurang = strlen($this->pt) - strlen($this->key);
            for ($i=0; $i < $kurang; $i++) { 
                $this->key .= $this->key[$i];
            }
        }

        //Generate cipher
        for ($i=0; $i < strlen($this->pt); $i++) {
            //Membaca perkarakter 
            $pti = $this->pt[$i];
            $keyi = $this->key[$i];
            //Mencari nilai indeks array
            $pti = array_search("$pti", $this->alpha);
            $keyi = array_search("$keyi", $this->alpha);
            //Rumus enkripsi Vigenere
            $result = ($pti+$keyi)%26;
            $this->cipher .= $this->alpha[$result];
        }
    return $this->cipher;
    }

    //Function untuk enkripsi
    public function decrypt($cp, $key){
        $this->cp = strtoupper($cp);
        $this->key = strtoupper($key);
        //Membuat key
        if(strlen($this->key) < strlen($this->cp)){
            $kurang = strlen($this->cp) - strlen($this->key);
            for ($i=0; $i < $kurang; $i++) { 
                $this->key .= $this->key[$i];
            }
        }

        //Generate plaintext
        for ($i=0; $i < strlen($this->cp); $i++) {
            //Membaca perkarakter 
            $cpi = $this->cp[$i];
            $keyi = $this->key[$i];
            //Mencari nilai indeks array
            $cpi = array_search("$cpi", $this->alpha);
            $keyi = array_search("$keyi", $this->alpha);
            //Rumus enkripsi Vigenere
            if(($cpi-$keyi) < 0 ){
                $result = ($cpi-$keyi)+26;
            }elseif(($cpi-$keyi) >= 0 ) {
                $result = ($cpi-$keyi)%26;
            }
            $this->plaintext .= $this->alpha[$result];
        }
    return $this->plaintext;
    }


    public function getKey(){
        return $this->key;
    }

    public function getPlaintext(){
        return $this->pt;
    }

    public function getCiphertext(){
        return $this->cp;
    }
}
?>