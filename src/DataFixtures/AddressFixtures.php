<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Address;

class AddressFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $list = [
            [
                'cityArea' => 'Hamdalaye Pharmacie',
            ],
            [
                'cityArea' => 'Kipé Dadia',
            ],
            [
                'cityArea' => 'Lambanyi',
            ],
        ];

        foreach ($list as $key => $values) {

            $address = new Address();
            $address->setCityArea($values['cityArea'])
                    ->setMunicipality($this->getReference('municipality_' . $key))
                    ->setUser($this->getReference('user_' . $key));

            $manager->persist($address);
            $manager->flush();

            $this->addReference('address_' . $key, $address);
        }
    }
}