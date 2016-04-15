<?php

namespace Ambta\DoctrineEncryptBundle\Encryptors;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * Class for variable encryption
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
        $this->secretKey = Key::loadFromAsciiSafeString($key);
    }

    /**
     * {@inheritdoc}
     */
    public function encrypt($data)
    {
        if (is_string($data)) {
            return Crypto::encrypt($data, $this->secretKey);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt($data)
    {
        if (is_string($data)) {
            return Crypto::decrypt($data, $this->secretKey);
        }

        return $data;
    }
}
