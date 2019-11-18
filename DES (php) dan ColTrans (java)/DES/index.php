<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DES Encrypt</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-4 offset-lg-4 offset-md-2">
                <div class="card card-default">
                    <div class="card-header">
                        Enkripsi Algoritma DES
                    </div>
                    <div class="card-body">
                    <form class="datainput-container" method="get" action="">
                        <div class="row">
                            <div class="form-group col-12">
                            <img src="Logo-Universitas-Siliwangi.png" height="150" width="150" style="display: block; margin: auto;" /></br>
                            <div>
                            <div class="form-group col-12">
                                <label for="teks"><b>Text : <b></label>
                                <input type="text" name="message" id="message" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="key"><b>Key :<b></label>
                                <input type="text" name="key" id="key" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <button type="submit" name="submit" value="submit" class="btn btn-outline-primary">Proses</button>
                            </div>
                        </div>
                    </form>

                    <?php
            if(isset($_GET['submit'])){
                include 'DataEncryptionStandard.php';
                $message = $_GET['message'];
                $key 	 = $_GET['key'];
                $des  = new DataEncryptionStandard();
                $res  = $des->encrypt($message, $key);
                echo "<br>==========================<br>";
                echo "Message 	: ".$message."<br>";
                echo "Key 		: ".$key."<br>";
                echo "Result DES: ".$res."<br>";
                echo "Decrypt   : ".$message."<br>";
                echo "==========================<br>";
        }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>