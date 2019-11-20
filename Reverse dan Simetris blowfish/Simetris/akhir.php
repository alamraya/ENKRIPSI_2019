<html>
<head>
<title>Dekripsi</title>
</head>
<body>
<style>
div.absolute {
    position: absolute;
    top: 80px;
    right: 960px;
    width: 300px;
    height: 400px;
    border: 4px solid #513145;
}    
div.warna{
	font-size: 24pt;
	font-style: bold;}
</style><div class="absolute">
<div class="warna"><h3> HASIL DECRYPT</h3><br>
<?php
$key = $_GET["key"];
$nmfile = "enkripsi.txt";
$fp = fopen($nmfile,"r"); 
$isi = fread($fp,filesize($nmfile));
for($i=0;$i<strlen($isi);$i++){
$kode[$i]=ord($isi[$i]); 
$b[$i]=($kode[$i] - $key ) % 256;
$c[$i]=chr($b[$i]);
}
echo "<br>";
for ($i=0;$i<strlen($isi);$i++)
{
echo $c[$i];
}
echo "<br>";
?>
<style>
body{
				background-image:url(3.jpg);
				background-size:cover;
				background-attachment: fixed;
		}</div>
</body>
</html>