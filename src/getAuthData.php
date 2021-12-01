<?php
require_once __DIR__ . '/AuthData.php';


function getAuthData($pan, $expDate, $cvv, $pin, $publicModulus = null, $publicExponent = null)
{
    $authData = AuthData::getAuthData($pan, $expDate, $cvv, $pin, $publicModulus, $publicExponent);
  
    return $authData;
}


$pan = "6280511000000095";
$expiryDate = "5004";
$cvv = "111";
$pin = "1111";
echo getAuthData(
    $pan,
    $expiryDate,
    $cvv,
    $pin
);