<?php
    require 'aes.class.php';     // AES PHP implementation
    require 'aesctr.class.php';  // AES Counter Mode implementation

    $timer = microtime(true);

    // initialise password & plaintext if not set in post array
    $pw = empty($_POST['pw']) ? ''            : $_POST['pw'];
    $pt = empty($_POST['pt']) ? '' : $_POST['pt'];
    $cipher = empty($_POST['cipher']) ? '' : $_POST['cipher'];
    $plain  = empty($_POST['plain'])  ? '' : $_POST['plain'];

    // perform encryption/decryption as required
    $encr = empty($_POST['encr']) ? $cipher : AesCtr::encrypt($pt, $pw, 256);
    $decr = empty($_POST['decr']) ? $plain  : AesCtr::decrypt($cipher, $pw, 256);
?>

<!DOCTYPE html>
<html>

<head>
  <title>AES</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container justify-content-center"> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar15">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar15">
        <ul class="navbar-nav">
          <li class="nav-item mx-2"> <a class="nav-link" href="aes.php">Algoritma AES</a> </li>
          <li class="nav-item mx-2"> <a class="nav-link navbar-brand mr-0 text-white" href="index.php"><i class="fa d-inline fa-lg fa-stop-circle-o"></i>
              <b>KRIPTOGRAFI</b></a> </li>
          <li class="nav-item mx-2"> <a class="nav-link" href="vigenere.php">Algoritma Vigenere Cipher</a> </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form class="" method="POST" action="">
            <h3 class="">Algoritma&nbsp;Advanced Encryption Standard (AES)</h3>
            <div class="form-group"> <label>Masukkan Password</label> <input type="text" name="pw" value="<?php if (isset($_POST['encr']) || isset($_POST['decr'])){echo $_POST['pw'];}?>" class="form-control" placeholder="password" required> </div>
            <div class="form-group"> <label>Masukkan Plaintext</label> <input type="text" name="pt" value="<?php if (isset($_POST['encr'])|| isset($_POST['decr'])){echo $_POST['pt'];}?>" class="form-control" placeholder="Plaintext"> </div>
            <button type="submit" name="encr" value="Encrypt it" class="btn btn-primary">ENCRYPT IT</button>
          
          <div class="card-body">
            <h4>HASIL CIPHERTEXT</h4>
            <p><?= $encr ?></p>
          </div>
          <div class="form-group"> <label>Masukkan Ciphertext</label> <input type="text" name="cipher" value="<?= $encr ?>" class="form-control" placeholder="Ciphertext"> </div>
          <button type="submit" name="decr" value="Decrypt it" class="btn btn-primary">DECRYPT IT</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <h4>HASIL PLAINTEXT</h4>
            <p><?= htmlspecialchars($decr) ?></p><br>
            <p><?= round(microtime(true) - $timer, 3) ?>s</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center d-md-flex align-items-center">
          <ul class="nav d-flex justify-content-center">
            <li class="nav-item"> <a class="nav-link active" href="index.php">Home</a> </li>
            <li class="nav-item"> <a class="nav-link" href="aes.php">AES</a> </li>
            <li class="nav-item"> <a class="nav-link" href="vigenere.php">Vigènere cipher</a> </li>
          </ul> <i class="d-block fa fa-stop-circle fa-3x mx-auto text-primary"></i>
          <p class="mb-0 py-1">©2019 Keamanan Informasi</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>