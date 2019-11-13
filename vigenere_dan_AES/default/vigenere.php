<?php

// initialize variables
$label="";
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";

// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('vigenere_function.php');
	
	// set the variables
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// check if password is provided
	if (empty($_POST['pswd']))
	{
		$error = "Please enter a password!";
		$valid = false;
	}
	
	// check if text is provided
	else if (empty($_POST['code']))
	{
		$error = "Please enter some text or code to encrypt or decrypt!";
		$valid = false;
	}
	
	// check if password is alphanumeric
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Password should contain only alphabetical characters!";
			$valid = false;
		}
	}
	
	// inputs valid
	if ($valid)
	{
		// if encrypt button was clicked
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Text encrypted successfully!";
			$color = "#526F35";
		}
			
		// if decrypt button was clicked
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Code decrypted successfully!";
			$color = "#526F35";
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>VIGENERE CIPHER</title>
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
            <h3 class="">Algoritma&nbsp;Vigènere Cipher</h3>
            <div class="form-group"> <label>Masukkan Key</label> <input type="text" name="pswd" id="pass" value="<?php echo htmlspecialchars($pswd); ?>"  class="form-control" placeholder="Key" required> </div>
            <div class="form-group"> <label >Masukkan <?php echo $label; if (isset($_POST['encrypt'])){echo "Ciphertext";}else if (isset($_POST['decrypt'])){echo "Plaintext";} else echo "Plaintext / Ciphertext ";?></label> <input id="box" name="code" class="form-control" placeholder="Plaintext" value="<?php echo htmlspecialchars($code); ?>"> </div>
            <button type="submit" name="encrypt" class="btn btn-primary">ENCRYPT IT</button>
            <button type="submit" name="decrypt" class="btn btn-primary">DECRYPT IT</button>
          </form>
          <!-- <div class="card-body">
            <h4>HASIL CIPHERTEXT</h4>
            <p><?php echo htmlspecialchars($code); ?></p>
          </div> -->
          <!-- <div class="form-group"> <label>CIPHERTEXT</label> <input type="text" name="" class="form-control" placeholder="Ciphertext" value="<?php echo htmlspecialchars($code); ?>"> </div> -->
         
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <h4>HASIL <?php echo $label; if (isset($_POST['encrypt'])){echo "CIPHERTEXT";}else if(isset($_POST['decrypt'])){echo "PLAINTEXT";}?></h4>
            <p><?php echo htmlspecialchars($code); ?></p>
            <div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div>
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