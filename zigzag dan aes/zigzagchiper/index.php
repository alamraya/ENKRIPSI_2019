<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZigZag Chiper</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-4 offset-lg-4 offset-md-2">
                <div class="card card-default">
                    <div class="card-header">
                        Zigzag Encoder & Decoder
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
                                <input type="number" name="key" id="key" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="type">Type :</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="1">Encode</option>
                                    <option value="2">Decode</option>
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
                            switch ($type) {
                                case '1':
                                    require 'src/RailFenceCipherEncode.php';
                                    $encode = new RailFenceCipherEncode();
                                    $stringToBeEncoded = $_POST['text'];
                                    $numberOfRails = $_POST['key'];
                                    $encodedString = $encode->encode($stringToBeEncoded, $numberOfRails);
                                    echo "Hasil Encode : <strong>" . $encodedString . "</strong>";
                                    break;
                                case '2':
                                    require 'src/RailFenceCipherDecode.php';
                                    $decode = new RailFenceCipherDecode();
                                    $stringToBeDecoded = $_POST['text'];
                                    $numberOfRails = $_POST['key'];
                                    $decodedString = $decode->decode($stringToBeDecoded, $numberOfRails);
                                    echo "Hasil Decode : <strong>" . $decodedString . "</strong>";
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