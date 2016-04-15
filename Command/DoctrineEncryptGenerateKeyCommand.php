<?php

namespace Ambta\DoctrineEncryptBundle\Command;

use Ambta\DoctrineEncryptBundle\Utils\SaltGenerator;
use Defuse\Crypto\Crypto;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Hello World command for demo purposes.
 *
 * You could also extend from Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * to get access to the container via $this->getContainer().
 *
 * @author Marcel van Nuil <marcel@ambta.com>
 */
class DoctrineEncryptGenerateKeyCommand extends ContainerAwareCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('doctrine:encrypt:generate-key')
            ->setDescription('Generate a secret key')
            ->addOption('salt', null, InputOption::VALUE_NONE, 'Generate a key used in addition of a salt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $salt = $input->getOption('salt');

        $key = Crypto::createNewRandomKey();
        $hexKey = Crypto::binToHex($key);

        if ($salt) {
            $hexKey = SaltGenerator::generate();
        }
        else {
            $key = Crypto::createNewRandomKey();
            $hexKey = Crypto::binToHex($key);
        }

        $output->writeln('Key: ' . $hexKey);
    }
}
