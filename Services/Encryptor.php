<?php
/*
 * Copyright 2015 Soeezy
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ambta\DoctrineEncryptBundle\Services;

class Encryptor
{
    /**
     * @var \Ambta\DoctrineEncryptBundle\Encryptors\EncryptorInterface
     */
    protected $encryptor;

    /**
     * Encryptor constructor.
     * 
     * @param string $encryptName
     * @param string $key
     */
    public function __construct($encryptName, $key)
    {
        $reflectionClass = new \ReflectionClass($encryptName);
        $this->encryptor = $reflectionClass->newInstanceArgs(
            array(
                $key,
            )
        );
    }

    /**
     * Get encryptor
     * 
     * @return \Ambta\DoctrineEncryptBundle\Encryptors\EncryptorInterface|object
     */
    public function getEncryptor()
    {
        return $this->encryptor;
    }

    /**
     * Decrypt data
     * 
     * @param string $string
     * @return string
     */
    public function decrypt($string, $salt = null)
    {
        return $this->encryptor->decrypt($string, $salt);
    }

    /**
     * Encrypt data
     * 
     * @param string $string
     * @return string
     */
    public function encrypt($string, $salt = null)
    {
        return $this->encryptor->encrypt($string, $salt);
    }
}
