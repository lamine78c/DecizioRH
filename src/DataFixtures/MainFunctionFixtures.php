<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\MainFunction;

class MainFunctionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $list = [
            'Ministre',
            'Secrétaire Général',
            'Chef deCabinet',
            'Conseiller principal',
            'Conseiller Juridique',
            'Directeur National',
            'Directeur National Adjoint',
            'Aiutre fonction'
        ];

        foreach ($list as $key => $value) {
            // Création d'un type de congé
            $mainFunction = new MainFunction();
            $mainFunction->setName($value);

            $manager->persist($mainFunction);
            $manager->flush();

            $this->addReference('mainFunction_' . $key, $mainFunction);
        }
    }
}