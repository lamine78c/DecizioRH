<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Entity;

class EntityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Autre département')
                ->setDescription('Autre département')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e0', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Cabinet du ministre')
                ->setDescription('Cabinet du ministre')
                ->setShortcut('CMT')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e1', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Direction Générale de la Coopération Bilatérale')
                ->setDescription('Direction Nationale de la Coopération Bilatérale')
                ->setShortcut('DGCB')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e2', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Direction Nationale des Investissements Publics ')
                ->setDescription('Direction Nationale des Investissements Publics ')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e3', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName("Direction Nationale de l'Intégration Africaine")
                ->setDescription("Direction Nationale de l'Intégration Africaine")
                ->setShortcut('DNIA')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e4', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Division des Ressources humaines')
                ->setDescription('Division des Ressources humaines')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e5', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName('Secrétariat Général')
                ->setDescription('Secrétariat Général')
                ->setShortcut('SG')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e6', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName("Service d'appui")
                ->setDescription("Service d'appui")
                ->setShortcut('SA')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e7', $entity);

        // Création d'une entité
        $entity = new Entity();
        $entity->setName("Direction Nationale")
                ->setDescription("Direction Nationale")
                ->setShortcut('DN')
                ->setCreatedAt(new \DateTime('2001-02-20'))
                ->setStartAt(new \DateTime('2001-02-20'));

        $manager->persist($entity);
        $manager->flush();

        $this->addReference('ref-e8', $entity);

//        // Création d'une entité
//        $entity = new Entity();
//        $entity->setName('Service Accueil et Information')
//                ->setDescription('Service Accueil et Information')
//                ->setCreatedAt(new \DateTime('2001-02-20'))
//                ->setStartAt(new \DateTime('2001-02-20'));
//
//        $manager->persist($entity);
//        $manager->flush();
//
//        $this->addReference('ref-e7', $entity);

    }
}