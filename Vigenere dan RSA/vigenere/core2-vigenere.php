<?php
class Vigenere{
    private $cipher, $plaintext, $key, $keyAsli, $pt, $cp;
    //Array untuk menentukkan nilai setiap karakter
    private $alpha = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    //Function untuk generate key
    private function generateKey($pt, $key){
        //Membuat key
        if(strlen($key) < strlen($pt)){
            $kurang = strlen($pt) - strlen($key);
            for ($i=0; $i < $kurang; $i++) { 
                $key .= $key[$i];
            }
        }
        return $key;
    }

    //Function untuk enkripsi
    public function encrypt($pt, $key){
        $this->pt = strtoupper($pt);
        $this->key = strtoupper($key);
        //Membuat key
        $this->keyAsli = $this->generateKey($this->pt, $this->key);

        //Generate cipher
        for ($i=0; $i < strlen($this->pt); $i++) {
            //Membaca perkarakter 
            $pti = $this->pt[$i];
            $keyi = $this->keyAsli[$i];
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
        $this->pt = strtoupper($pt);
        $this->key = strtoupper($key);
        //Membuat key
        $this->keyAsli = $this->generateKey($this->pt, $this->key);

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

    public function getKeyAsli(){
        return $this->keyAsli;
    }

    public function getPlaintext(){
        return $this->pt;
    }

    public function getCiphertext(){
        return $this->cp;
    }
}
?>