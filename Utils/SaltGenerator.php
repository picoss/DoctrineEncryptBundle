<?php

namespace Ambta\DoctrineEncryptBundle\Utils;

use Defuse\Crypto\Crypto;

class SaltGenerator
{
    /**
     * Generate salt
     * 
     * @return string
     */
    static function generate()
    {
        $key = Crypto::createNewRandomKey();
        $hexKey = Crypto::binToHex($key);
        $hexKey = substr($hexKey, 0, (strlen($hexKey) / 2));

        return $hexKey;
    }
}