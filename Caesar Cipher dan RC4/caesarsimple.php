<?php
    function Encipher($input, $key)
    {
        $output = "";

        $inputArr = str_split($input);
        foreach ($inputArr as $ch)
            $output .= Cipher($ch, $key);

        return $output;
    }

    function Decipher($input, $key)
	{
		return Encipher($input, 26 - $key);
    }
    
    function Cipher($ch, $key)
	{
	    if (!ctype_alpha($ch))
			return $ch;
			$offset = ord(ctype_upper($ch) ? 'A' : 'a');
			return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAESAR CHIPER ENCRYPT</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-4 offset-lg-4 offset-md-2">
                <div class="card card-default">
                    <div class="card-header">
                        Enkripsi Algoritma CAESAR CIPHER
                    </div>
                    <div class="card-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="teks">Text : </label>
                                <input type="text" name="text" id="text" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="key">Deret :</label>
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
                                    $cipherText = Encipher($text, $key);
                                    echo "Hasil Encrypt : <strong>" . $cipherText . "</strong>";
                                    break;
                                case '2':                                                                      
                                    $cipherText = Decipher($text, $key);
                                    echo "Hasil Decrypt : <strong>" . $cipherText . "</strong>";
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