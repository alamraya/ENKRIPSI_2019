<?php

$hasil = $_POST['plain_hasil'];

// Menyimpan hasil dekripsi ke dalam file.txt
$fileName = gmdate("H-i-s-d-m-y", time()+3600*7).".txt";
$file_enkripsi = fopen($fileName, "w") or die('Cannot save file:  '.$fileName);
fwrite($file_enkripsi, $hasil);
fclose($file_enkripsi);
//menyimpan file pada folder doc dengan nama tanggal
rename ($fileName, "enkripsi/".$fileName."");

?>