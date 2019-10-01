<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Municipality;

class MunicipalityFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $list = [
            'Matam',
            'Kaloum',
            'Dixinn',
            'Matoto',
            'Ratoma',
            'Dubréka',
            'Coyah',
            'Kindia',
            'Boffa'
        ];

        foreach ($list as $key => $value) {
            // Création d'un type de congé
            $municipality = new Municipality();
            $municipality->setName($value);

            $manager->persist($municipality);
            $manager->flush();

            $this->addReference('municipality' . $key, $municipality);
        }
    }
}