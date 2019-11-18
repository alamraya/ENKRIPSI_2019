<?php require 'core-vigenere.php'; $vigenere = new Vigenere;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Decrypt Vigenere</title>
</head>
<body>
    <h1>Decrypt Vigenere</h1>
    <table>
        <form action="" method="POST">
            <tr>
                <td>Cipher Text</td>
                <td><textarea name="ciphertext" cols="40" rows="10" value="<?= $vigenere->getPlaintext();?>" required></textarea></td>
            </tr>
            <tr>
                <td>Key</td>
                <td><input type="text" name="key" required></td>
            </tr>
            <?php if(isset($_POST["submit"])) : ?>
            <tr>
                <td>Plaintext</td>
                <td colspan="2"><textarea name="cipher" id="cipher" cols="40" rows="10" readonly><?= $vigenere->decrypt($_POST["ciphertext"], $_POST["key"])?></textarea></td>
            </tr>
            <?php endif;?>
            <tr>
                <td></td>
                <td><button type="submit" name="submit">Submit</button> | <button type="reset" name="reset">Reset</button> | <a href="input-vigenere.php">Kembali</a></td>
            </tr>
        </form>
    </table>
</body>
</html>