<?php

namespace Ambta\DoctrineEncryptBundle\Configuration;

use Doctrine\Common\Annotations\Annotation;

/**
 * The Encrypted class handles the @Encrypted annotation.
 *
 * @Annotation
 */
class Encrypted extends Annotation
{
    /** @var string */
    public $pass;
}