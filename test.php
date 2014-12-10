<?php
$pass='x';
$handle = "chido bato";
$method = 'AES-256-CBC';

$iv_size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
$iv ='1234567890123456'; mcrypt_create_iv($iv_size, MCRYPT_RAND);


//$enctxt = openssl_encrypt ($handle, $method, $pass, 0, $iv);
//echo $enctxt;
//var_dump($enctxt);

$enctxt = 'bRM3lPIebcTIjroxJs7LBQ==';
echo openssl_decrypt($enctxt, $method, $pass, 0, $iv);
