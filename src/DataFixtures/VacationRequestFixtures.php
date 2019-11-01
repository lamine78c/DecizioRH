<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\VacationRequest;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\VacationTypeFixtures;
use App\DataFixtures\RequestStatusFixtures;

class VacationRequestFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $endAt = new \DateTime();
        $endAt->modify('+5 day');
        for ($i=0; $i < 6; $i++) {
            
            $vacationRequest = new VacationRequest(); 
            $vacationRequest->setStartAt(new \DateTime())
                    ->setEndAt($endAt)
                    ->setUser($this->getReference('user_' . $i))
                    ->setUserComment('simple commentaire')
                    ->setVacationType($this->getReference(VacationTypeFixtures::VACATION_TYPE_REFERENCE_CA))
                    ->setRequestStatus($this->getReference('status-0'));
            
            $manager->persist($vacationRequest);
            $manager->flush();
        }
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            VacationTypeFixtures::class,
            RequestStatusFixtures::class,
        );
    }
}