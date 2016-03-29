<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\ApiKey;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadApiKeyData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $apiKey = new ApiKey();
        $apiKey->setUser($this->getReference('user'))
            ->setApiKey('test-key');

        $manager->persist($apiKey);
        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}