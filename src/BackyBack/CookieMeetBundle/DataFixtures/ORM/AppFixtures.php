<?php

namespace BackyBack\CookieMeetBundle\DataFixture;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class AppFixtures extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/users.yml',
            __DIR__.'/recepee.yml'
        ];
    }
}