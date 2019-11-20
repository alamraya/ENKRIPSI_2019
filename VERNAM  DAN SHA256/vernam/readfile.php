<?php
$fileChyper = $_FILES['filetxt']['name'];
$fileName = gmdate("H-i-s-d-m-y", time()+3600*7).".txt";
//menyimpan file pada folder doc dengan nama tanggal
move_uploaded_file($_FILES['filetxt']['tmp_name'], 'file/'.$fileName);
//mengambil isi dari file
$plain = file_get_contents('file/'.$fileName);
echo $plain;
?>