<html>
<head>
<title>Dekripsi</title>
</head>
<body>
<style>
div.absolute {
    position: absolute;
    top: 80px;
    right: 500px;
    width: 300px;
    height: 550px;
    border: 4px solid #513145;
}    
div.warna{
	
	font-size: 24pt;
	font-style: bold;
}
</style><div class="absolute">
<div class="warna"><h3>hasil enkripsi: </h3><br>
<?php
$kalimat = $_GET["kata"];
$key = $_GET["key"];
for($i=0;$i<strlen($kalimat);$i++)
{
$kode[$i]=ord($kalimat[$i]); 
$b[$i]=($kode[$i] + $key ) % 256; 
$c[$i]=chr($b[$i]);
}
echo "";
$hsl = '';
for ($i=0;$i<strlen($kalimat);$i++)
{
echo $c[$i];
$hsl = $hsl . $c[$i];
}
echo "<br>";
//simpan data di file
$fp = fopen ("enkripsi.txt","w");
fputs ($fp,$hsl);
fclose($fp);
?>
<form action="akhir.php" method="get">
Key : <input type="text" name="key" maxlength="2"> <br>
<input type="submit" value="decrypt">
<input type="reset" value="Reset">
</form>
</div>
</div>
<style>
body{
				background-image:url(4.jpg);
				background-size:cover;
				background-attachment: fixed;
		}</div>
    
</body>
</html>