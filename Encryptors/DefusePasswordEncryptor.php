<?php

namespace Ambta\DoctrineEncryptBundle\Encryptors;

use Defuse\Crypto\Crypto;

/**
 * Class for variable encryption
 */
class DefusePasswordEncryptor implements EncryptorInterface
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
        $this->secretKey = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function encrypt($data, $pass = null)
    {
        if (is_string($data)) {
            return Crypto::encryptWithPassword($data, $this->getPassword($pass));
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt($data, $pass = null)
    {
        if (is_string($data)) {
            return Crypto::decryptWithPassword($data, $this->getPassword($pass));
        }

        return $data;
    }

    /**
     * Get passwordw
     *
     * @param null $pass
     * @return string
     */
    public function getPassword($pass = null)
    {
        return $this->secretKey . strrev($pass);
    }
}
