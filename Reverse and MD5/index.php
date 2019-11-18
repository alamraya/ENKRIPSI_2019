<?php
    $plaintext = "";
    $md5 = "";
    if (isset($_POST['plaintext'])) 
    {
        $plaintext = $_POST['plaintext'];
        $revers = strrev($plaintext);
        $md5 = md5($plaintext);
    }else
    {
        $revers = "";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" media="all">
    <title>Cryptography</title>
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Cryptography</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        
                        <div class="form-row">
                            <div class="name">Plaintext</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="plaintext" value="<?=$plaintext?>" placeholder="Plaintext" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Ciphertext</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" disabled value="<?=$revers?>" placeholder="Ciphertext">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                                <div class="name">Md5</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" name="md5" value="<?=$md5?>" placeholder="Md5 ciphertext" disabled>
                                    </div>
                                </div>
                            </div>
                       
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
