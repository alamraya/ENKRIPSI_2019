<?php
    function rc4($key, $str) {

        $s = array();
    
        for ($i = 0; $i < 256; $i++) {
    
            $s[$i] = $i;    //inisialisasi state array
    
        }
    
        $j = 0;
    
        for ($i = 0; $i < 256; $i++) {
    
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
    
            $x = $s[$i];
    
            $s[$i] = $s[$j];
    
            $s[$j] = $x;
    
        }
    
        $i = 0;
    
        $j = 0;
    
        $res = '';
    
            
    
        for ($y = 0; $y < strlen($str); $y++) {
    
            $i = ($i + 1) % 256;
    
            $j = ($j + $s[$i]) % 256;
    
            $x = $s[$i];
    
            $s[$i] = $s[$j];
    
            $s[$j] = $x;
    
            $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
    
        }
    
        return $res;
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RC4 ENCRYPT</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-4 offset-lg-4 offset-md-2">
                <div class="card card-default">
                    <div class="card-header">
                        Enkripsi Algoritma RC4
                    </div>
                    <div class="card-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="teks">Text : </label>
                                <input type="text" name="text" id="text" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="key">Key :</label>
                                <input type="text" name="key" id="key" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="type">Type :</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="1">Encrypt</option>
                                    <option value="2">Decrypt</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" name="submit" class="btn btn-success">Proses</button>
                            </div>
                        </div>
                    </form>

                    <?php
                        if(isset($_POST['submit'])){
                            $type = $_POST['type'];
                            $key = $_POST['key'];
                            $text = $_POST['text'];
                            switch ($type) {
                                case '1':
                                    $enkripsi = rc4($key,$text);
                                    $encode = base64_encode($enkripsi);
                                    echo "Hasil Encrypt : <strong>" . $encode . "</strong>";
                                    break;
                                case '2':                                                                      
                                    $decode = base64_decode($text);
                                    echo "Hasil Decrypt : <strong>" . rc4($key,$decode) . "</strong>";
                                break;
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>