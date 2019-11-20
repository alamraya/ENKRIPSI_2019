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
    width: 500px;
    height: 300px;
    border: 4px solid #513145;
}    
div.warna{
	
	font-size: 24pt;
	font-style: bold;
}
</style><div class="absolute">
<div class="warna"><h3>HASIL ENCRYPT REVERSE</h3><br></div>
<?php
$kalimat = $_GET["kata"];
	    $lenght = strlen($kalimat);
	    for($i=0;$i<($lenght-1)/2;$i++)
	    {
	        $tampung = $kalimat[$i];
	        $kalimat[$i] = $kalimat[$lenght-$i-1];
	        $kalimat[$lenght-$i-1] = $tampung;
	    }
        echo "Hasilnya : ".$kalimat;
        echo "<br>";    
        $fp = fopen ("enkripsireverse.txt","w");
fputs ($fp,$kalimat);
fclose($fp);
	?>
<form action="baliklagi.php" method="get">
Chipperteks :<br><input type="text" name="kalimat"><br>
<input type="submit" value="Decrypt">
<input type="reset" value="Reset">
</div>
<style>
		body{
				background-image:url(4.jpg);
				background-size:cover;
				background-attachment: fixed;
		}
</body>
</html>