<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Vacation;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\VacationTypeFixtures;

class VacationFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        for ($i=0; $i < 10; $i++) {
            
            $vacation = new Vacation();            
            $vacation->setPeriod(new \DateTime('2019-05-31'))
                    ->setStartAt(new \DateTime())
                    ->setWin(8)
                    ->setSpent(2)
                    ->setUser($this->getReference('user_' . $i))
                    ->setVacationType($this->getReference(VacationTypeFixtures::VACATION_TYPE_REFERENCE_CA));
            
            $manager->persist($vacation);            
             $manager->flush();
        }
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            VacationTypeFixtures::class,
        );
    }
}