<?php

namespace Ambta\DoctrineEncryptBundle\Configuration;

use Doctrine\Common\Annotations\Annotation;

/**
 * The Encrypted class handles the @Encrypted annotation.
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 * @Annotation
 */
class Encrypted extends Annotation
{
    /** @var string */
    public $salt;
}