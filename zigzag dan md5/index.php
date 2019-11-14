<?php
require("function.php");
$plaintext="";
$md5 ="";
$zigzag="";
$key="";
if (isset($_POST['plaintext'])) {
    $plaintext =$_POST['plaintext'];
    $key = $_POST['key'];
    $zigzag = encode($plaintext,$key);
    $md5 = md5($plaintext);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Implementasi Algoritma ZigZag dan MD5</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-4 offset-lg-4 offset-md-2">
            <div class="card card-default">
                <div class="card-header">
                <h4>Algoritma Zigzag dan MD5</h4>
                </div>
                <div class="card-body">
                <form  method="post">
                    <!-- form plaintext -->
                    <label for="plaintext">Plaintext :</label>
                    <input type="text" class="form-control" placeholder="masukan plaintext" name="plaintext" id="plaintex" value="<?=$plaintext?>" required><br>
                    
                    <!-- form select -->
                    <label for="key">key :</label>
                    <select name="key" id="" class="form-control">
                        <option ><?php echo(isset($_POST['key']) ? $_POST['key'] : "pilih key" ); ?></option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        
                    </select><br>

                    <!-- button submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Proceed</button><br><br>
                    
                    <!-- tampil hasil zigzag -->
                    <label for="zigzag">Chiper zigzag :</label>
                    <input type="text" class="form-control" placeholder="hasil enkripsi zigzag" name="zigzag" id="zigzag" value="<?=$zigzag?>" disabled>
                   
                    <!-- tampil hasil md5 -->
                    <label for="md5">MD5 :</label>
                    <input type="text" class="form-control" placeholder="hasil enkripsi md5" name="md5" id="md5" value="<?=$md5?>" disabled><br><br>
                    </form>
                 </div>
                </div>
                </div>
</div>  
</body>
</html>