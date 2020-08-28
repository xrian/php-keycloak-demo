<?php
require_once('../vendor/autoload.php');

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

function str_starts_with($source, $str)
{
    if (strlen($source) < strlen($str)) {
        return false;
    }
    return substr($source, 0, strlen($str)) == $str;
}

function str_ends_with($source, $str)
{
    if (strlen($source) < strlen($str)) {
        return false;
    }
    return substr($source, strlen($source) - strlen($str)) == $str;
}

/*
 * @throws UnexpectedValueException     Provided JWT was invalid
 * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
 * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
 * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
 * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
 */
function validate($token, $publicKeyStr, $config)
{

    $decoded = JWT::decode($token, $publicKeyStr, array('RS256'));
    $iss = $decoded->iss;
    $azp = $decoded->azp;
    if (!str_starts_with($iss, $config['auth-server-url'])) {
        throw new UnexpectedValueException('Invalid Auth Server Url');
    }
    if (!str_ends_with($iss, $config['realm'])) {
        throw new UnexpectedValueException('Invalid Realm');
    }
    if ($azp != $config['resource']) {
        throw new UnexpectedValueException('Invalid Resource');
    }
    return $decoded;
}









