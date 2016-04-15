<?php

namespace Ambta\DoctrineEncryptBundle\Encryptors;

/**
 * Encryptor interface for encryptors
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
interface EncryptorInterface
{

    /**
     * Must accept secret key for encryption
     * @param string $secretKey the encryption key
     */
    public function __construct($secretKey);

    /**
     * @param string $data Plain text to encrypt
     * @param string $salt Salt
     * @return string Encrypted text
     */
    public function encrypt($data, $salt = null);

    /**
     * @param string $data Encrypted text
     * @param string $salt Salt
     * @return string Plain text
     */
    public function decrypt($data, $salt = null);
}
