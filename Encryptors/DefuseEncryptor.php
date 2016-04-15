<?php

namespace Ambta\DoctrineEncryptBundle\Encryptors;

use Defuse\Crypto\Crypto;

/**
 * Class for variable encryption
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class DefuseEncryptor implements EncryptorInterface
{
    /**
     * @var string
     */
    private $secretKey;

    /**
     * {@inheritdoc}
     */
    public function __construct($key)
    {
        if (!$this->checkKey($key)) {
            throw new \Exception('Invalid encryptor key length');
        }
        $this->secretKey = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function encrypt($data, $salt = null)
    {
        if (is_string($data)) {
            return base64_encode(Crypto::encrypt($data, $this->secretKey));// . '<ENC>';
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt($data, $salt = null)
    {
        if (is_string($data)) {
            return Crypto::decrypt(base64_decode($data), $this->secretKey);
        }

        return $data;
    }

    private function checkKey($key)
    {
        $key = Crypto::hexToBin($key);
        $length = 0;
        if (function_exists('mb_strlen')) {
            $length = mb_strlen($key, '8bit');
            if ($length == false) {
                throw new \Exception('mb_strlen() failed.');
            }
        }
        else {
            $length = strlen($key);
        }

        return $length === Crypto::KEY_BYTE_SIZE;
    }
}
