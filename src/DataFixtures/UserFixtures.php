<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $list = [
            [
                'firstName' => 'Mohamed',
                'lastName' => 'Camara',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
            [
                'firstName' => 'Mory',
                'lastName' => 'Kaba',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
                        [
                'firstName' => 'Fatoumata',
                'lastName' => 'Cissé',
                'matricule' => '',
                'gender' => 'femme',
            ],
            [
                'firstName' => 'Alpha',
                'lastName' => 'Barry',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
                        [
                'firstName' => 'Oumou',
                'lastName' => 'Souaré',
                'matricule' => '88888888',
                'gender' => 'femme',
            ],
            [
                'firstName' => 'Mafoudia',
                'lastName' => 'Soumah',
                'matricule' => '88888888',
                'gender' => 'femme',
            ],
                        [
                'firstName' => 'Amara',
                'lastName' => 'Keita',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
            [
                'firstName' => 'Ibrahima',
                'lastName' => 'Diallo',
                'matricule' => '88888888',
                'gender' => '',
            ],
            [
                'firstName' => 'Namory',
                'lastName' => 'Condé',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
                        [
                'firstName' => 'Roland',
                'lastName' => 'Lamah',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
            [
                'firstName' => 'Binta',
                'lastName' => 'Baldé',
                'matricule' => '',
                'gender' => 'femme',
            ],
                        [
                'firstName' => 'Fatou',
                'lastName' => 'Bangoura',
                'matricule' => '88888888',
                'gender' => 'femme',
            ],
            [
                'firstName' => 'Ismael',
                'lastName' => 'Fadiga',
                'matricule' => '88888888',
                'gender' => 'homme',
            ],
                        [
                'firstName' => 'Fanta',
                'lastName' => 'Diop',
                'matricule' => '88888888',
                'gender' => 'femme',
            ]
        ];

        foreach ($list as $key => $values) {

            $ref = $key%7;

            $user = new User();
            $user->setFirstName($values['firstName'])
                    ->setLastName($values['lastName'])
                    ->setMatricule($values['matricule'])
                    ->setGender($values['gender'])
                    ->setEntity($this->getReference('ref-e' . $ref))
                    ->setRoles($values)
                    ->setMainFunction($mainFunction)
                    ->setPassword($password);




            $manager->persist($user);
            $manager->flush();

            $this->addReference('user_' . $key, $user);
        }

    }
}