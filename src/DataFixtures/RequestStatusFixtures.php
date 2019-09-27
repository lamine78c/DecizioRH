<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\RequestStatus;

class RequestStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $statusList = ['En cours', 'Validée', 'Rejetée'];
        
        foreach ($statusList as $value) {
            $status = new RequestStatus();
            $status->setName($value);
            
            $manager->persist($status);

            $manager->flush();
        }

    }
}
