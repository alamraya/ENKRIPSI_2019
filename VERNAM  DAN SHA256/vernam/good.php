<?php
$plain = 'fhgm&*)+43646GJHGJ';
$key = key_generator($plain);
echo 'plain = '.$plain.'</br>';

function vernam_enkripsi($plain, $key){
	$n = strlen($plain);
	for($i=0;$i<$n;$i++){
		$data[$i] = str_pad(decbin(ord($plain[$i])), 8, "0", STR_PAD_LEFT);
		$kunci[$i] = str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT);
		//echo 'biner data ='.str_pad(decbin(ord($plain[$i])), 8, "0", STR_PAD_LEFT).', biner kunci = '.str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT).' ';
		//opeasi xor
		for($j=0;$j<8;$j++){
			$hasil[$j] = ($data[$i][$j] + $kunci[$i][$j])%2;
		}
		
		$result[$i] = implode($hasil);
		//echo 'biner hasil = '.$result[$i];
		$chiper[$i] = chr(normalize(bindec($result[$i])));
		//echo ', biner chiper = '.$chiper[$i];

		//echo ' '.ord($plain[$i]).', key ='.ord($key[$i]).', hasil = '.bindec($result[$i]).', normalisasi ='.normalize(bindec($result[$i])).'<br/>';
	}
	$chiperKey = implode($chiper);
	return $chiperKey;
}

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

function normalize($dec){
	//return ($dec%94)+33;
	return ($dec%126)+33;
	//return $dec+33;
}

function key_generator($plain){
	$n = strlen($plain);
	return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $n);
}

echo 'kunci = '.$key.'<br/>';
$chiper = vernam_enkripsi($plain, $key);
echo 'hasil chiper ='.$chiper.'<br/>';
echo 'hasil dekrip ='.vernam_dekripsi($chiper, $key);
?>