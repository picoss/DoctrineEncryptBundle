<?php

namespace Ambta\DoctrineEncryptBundle\Encryptors;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * Class for variable encryption
 */
class DefuseSplitKeyEncryptor implements EncryptorInterface
{
    /**
     * @var Key
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
    public function encrypt($data, $key = null)
    {
        if (is_string($data)) {
            return Crypto::encrypt($data, $this->getKey($key));
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt($data, $key = null)
    {
        if (is_string($data)) {

            return Crypto::decrypt($data, $this->getKey($key));
        }

        return $data;
    }

    /**
     * Get key
     *
     * @param null $key
     * @return string
     */
    public function getKey($key = null)
    {
        return Key::loadFromAsciiSafeString(Crypto::decrypt($key, $this->secretKey));
    }

    /**
     * Generate key
     *
     * @return string
     */
    public function generateKey()
    {
        $key = Key::createNewRandomKey();
        return Crypto::encrypt($key->saveToAsciiSafeString(), $this->secretKey);
    }
}
