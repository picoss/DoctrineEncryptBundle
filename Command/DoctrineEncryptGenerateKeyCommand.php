<?php

namespace Ambta\DoctrineEncryptBundle\Command;

use Defuse\Crypto\Key;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = Key::createNewRandomKey();
        $safeKeyString = $key->saveToAsciiSafeString();

        $output->writeln('Key: ' . $safeKeyString);
    }
}
