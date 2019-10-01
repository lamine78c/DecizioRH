<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

//use App\Entity\VacationType;

class VacationTypeFixtures extends Fixture
{
    public const VACATION_TYPE_REFERENCE_CA = 'conges-ca';
    public const VACATION_TYPE_REFERENCE_CSS = 'conges-css';
    public const VACATION_TYPE_REFERENCE_CAS = 'conges-cas';

    public function load(ObjectManager $manager)
    {

        // Création d'un type de congé
        $vacationType = new VacationType();
        $vacationType->setName('Congés annuels')
                ->setShortcut('CA')
                ->setDescription('Congés payés annuels')
                ->setBasicValue(2.5)
                ->setMaxAllowed(28);

        $manager->persist($vacationType);
        $manager->flush();

        $this->addReference(self::VACATION_TYPE_REFERENCE_CA, $vacationType);

        // Création d'un type de congé
        $vacationType = new VacationType();
        $vacationType->setName('Congés sans solde')
                ->setShortcut('CSS')
                ->setDescription('Congés payés annuels');

        $manager->persist($vacationType);
        $manager->flush();

        $this->addReference(self::VACATION_TYPE_REFERENCE_CSS, $vacationType);

        // Création d'un type de congé
        $vacationType = new VacationType();
        $vacationType->setName('Congés Affaires sociales')
                ->setShortcut('CAS')
                ->setDescription('Congés Affaires sociales (Naissance, décès, mariage) de la famille proche');

        $manager->persist($vacationType);
        $manager->flush();

        $this->addReference(self::VACATION_TYPE_REFERENCE_CAS, $vacationType);

    }
}