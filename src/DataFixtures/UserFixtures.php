<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\User;
use App\DataFixtures\EntityFixtures;
use App\DataFixtures\MainFunctionFixtures;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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
                'gender' => 'homme',
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
        
        // Admin user
        $user = new User();
        $user->setEmail('admin@gmail.com')
                ->setFirstName('Admin test')
                ->setLastName('Admin test')
                ->setMatricule('11111111')
                ->setEntity($this->getReference('ref-e1'))
                ->setRoles(['ROLE_ADMIN']);

        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
        
        $this->addReference('user_admin', $user);

        // Créer d'autres users
        foreach ($list as $key => $values) {

            $ref = $key%7;
            
            $user = new User();
            $user->setFirstName($values['firstName'])
                    ->setLastName($values['lastName'])
                    ->setMatricule($values['matricule'])
                    ->setGender($values['gender'])
                    ->setEntity($this->getReference('ref-e' . $ref))
                    ->setRoles(['ROLE_USER'])
                    ->setMainFunction($this->getReference('mainFunction_default'));
            
            $password = $this->encoder->encodePassword($user, 'user');

            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            $this->addReference('user_' . $key, $user);
        }

    }
    
    public function getDependencies()
    {
        return array(
            MainFunctionFixtures::class,
            EntityFixtures::class,
        );
    }
}