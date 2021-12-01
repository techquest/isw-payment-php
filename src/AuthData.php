<?php

include_once 'Constants.php';
include_once __DIR__.'/Crypt/RSA.php';
include_once __DIR__.'/Math/BigInteger.php';


class AuthData
{
    public static function getAuthData($pan, $expDate, $cvv, $pin, $publicModulus = null, $publicExponent = null)
    {
        if (is_null($publicModulus)) {
            $publicModulus = Constants::PUBLICKEY_MODULUS;
        }
      
        if (is_null($publicExponent)) {
            $publicExponent = Constants::PUBLICKEY_EXPONENT;
        }
      
      
        $authDataCipher = '1Z' . $pan . 'Z' . $pin . 'Z' . $expDate . 'Z' . $cvv;
        $rsa = new Crypt_RSA();
        $modulus = new Math_BigInteger($publicModulus, 16);
        $exponent = new Math_BigInteger($publicExponent, 16);
        $rsa->loadKey(array('n' => $modulus, 'e' => $exponent));
        $rsa->setPublicKey();
        $pub_key = $rsa->getPublicKey();
      
      
        openssl_public_encrypt($authDataCipher, $encryptedData, $pub_key);
        $authData = base64_encode($encryptedData);
      
        return $authData;
    }
}