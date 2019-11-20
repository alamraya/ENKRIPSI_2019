<?php
function vernam_dekripsi($chiper, $key){
	$n = strlen($chiper);
	for($i=0;$i<$n;$i++){
		$data[$i] = str_pad(decbin(ord($chiper[$i])-33), 8, "0", STR_PAD_LEFT);
		$kunci[$i] = str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT);
		//echo 'biner ciper ='.str_pad(decbin(ord($chiper[$i])-33), 8, "0", STR_PAD_LEFT).', biner kunci = '.str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT).' ';
		//opeasi xor
		for($j=0;$j<8;$j++){
			$hasil[$j] = ($data[$i][$j] + $kunci[$i][$j])%2;
		}
		$result[$i] = implode($hasil);
		//echo 'biner dekrip = '.$result[$i];
		$plain[$i] = chr(bindec($result[$i]));

		//echo ' '.ord($chiper[$i]).', key ='.ord($key[$i]).', hasil = '.bindec($result[$i]).'<br/>';
	}
	$plainText = implode($plain);
	return $plainText;
}

// Mengubah ENTER atau NEW LINE menjadi SPASI
$chiper = preg_replace("/\n/", "", $_POST['chiper_text']);
$key = $_POST['key'];
$plain = vernam_dekripsi($chiper, $key);
// Menyimpan hasil dekripsi ke dalam file.txt
$fileName = gmdate("H-i-s-d-m-y", time()+3600*7).".txt";
$file_dekripsi = fopen($fileName, "w") or die('Cannot save file:  '.$fileName);
fwrite($file_dekripsi, $plain);
fclose($file_dekripsi);
//menyimpan file pada folder doc dengan nama tanggal
rename ($fileName, "dekripsi/".$fileName."");

echo $plain;
?>