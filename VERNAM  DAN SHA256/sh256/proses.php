<?php
  //  echo $_GET['nama'];
  
  //  echo "<br />";
  //  echo $_GET['email'];


  function encrypt_decrypt($action, $string)
  {
    $output = false;
   
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
   
    // hash
    $key = hash('sha256', $secret_key);
   
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a
    // warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
   
    if ($action == 'encrypt')
    {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
    }
    else
    {
      if ($action == 'decrypt')
      {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
    }
   
    return $output;
  }
   
   
  //
  // usage
  //
   
  
   
  // $plain_txt = "BELAJAR KEAMANAN INFORMASI";
  // echo "Plain Text = $plain_txt\n";
   


  $encrypted_txt = encrypt_decrypt('encrypt', $_GET['nama']);
  // echo "";
  // <BR>
  // </BR>
  echo "Encrypted Text = $encrypted_txt\n";
   
  $decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
  echo "Decrypted Text = $decrypted_txt\n";
   
  // if ($_GET === $decrypted_txt)
  //   echo "SUCCESS";
  // else
  //   echo "FAILED";
   
  // echo "\n";

   
  ?>

