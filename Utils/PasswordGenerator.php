<?php

namespace Ambta\DoctrineEncryptBundle\Utils;

use RandomLib\Factory;
use RandomLib\Generator;

class PasswordGenerator
{
    public static function generate($length = 32)
    {
        $factory = new Factory();
        $generator = $factory->getMediumStrengthGenerator();

        $charsList = Generator::CHAR_ALNUM
            | Generator::CHAR_ALPHA
            | Generator::CHAR_BRACKETS
            | Generator::CHAR_DIGITS
            | Generator::CHAR_PUNCT
            | Generator::CHAR_SYMBOLS;

        return $generator->generateString($length, $charsList);
    }
}