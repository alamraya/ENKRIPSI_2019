<?php
function key_generator($plain){
	$n = strlen($plain);
	return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $n);
}
function randomString($plain) {
	$length = strlen($plain);
	$str = "";
	$characters = array_merge(range('a','z'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

$plain = $_POST['plain_text'];
$key = randomString($plain);
echo $key;
?>