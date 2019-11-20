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
<div class="warna"><h3>HASIL DECRYPT</h3><br></div><?php
$kata = $_GET["kalimat"];
	    $lenght = strlen($kata);
	    for($i=0;$i<($lenght-1)/2;$i++)
	    {
	        $tampung = $kata[$i];
	        $kata[$i] = $kata[$lenght-$i-1];
	        $kata[$lenght-$i-1] = $tampung;
	    }
        echo "Hasilnya : ".$kata;
        echo "<br>";    
        $fp = fopen ("docreverse.txt","w");
fputs ($fp,$kata);
fclose($fp);
	?>
    </div>
    <style>
		body{
				background-image:url(4.jpg);
				background-size:cover;
				background-attachment: fixed;
		}
</body>
</html>