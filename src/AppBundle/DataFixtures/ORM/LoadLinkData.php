<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Link;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLinkData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $link = new Link();
        $link->setClicks(0)
            ->setCode('test')
            ->setUrl('http://google.be')
            ->setUser($this->getReference('user'));

        $manager->persist($link);
        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}