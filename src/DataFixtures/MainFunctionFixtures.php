<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\MainFunction;

class MainFunctionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        // Une fonction par défaut
        $mainFunction = new MainFunction();
        $mainFunction->setName('Autre fonction');

        $manager->persist($mainFunction);
        $manager->flush();

        $this->addReference('mainFunction_default', $mainFunction);

        $list = array (
            [
                'name' => 'Ministre',
                'shortcut' => 'MST',
                'description' => 'Gère la politique étrangère du gouvernement'
             ],
            [
                'name' => 'Secrétaire Général',
                'shortcut' => 'SG',
                'description' => 'Coordonne les directions ou les services du ministère'
             ],
            [
                'name' => 'Inspecteur Général',
                'shortcut' => 'IG',
                'description' => "S'occupe de l'inspection générale"
             ],
            [
                'name' => 'Directrice générale adjointe de la Coopération bilatérale',
                'shortcut' => 'DCB',
                'description' => "S'occupe de la coopération bilatérale"
             ],
            [
                'name' => 'Conseiller Juridique',
                'shortcut' => 'CJ',
                'description' => "Chargé de donner des conseils juridique"
             ],
            [
                'name' => "Directrice générale de l'intégration africaine",
                'shortcut' => 'DGIA',
                'description' => "S'occupe des questions liées à l'integration africaine"
             ],
            [
                'name' => "Directrice général adjoint de l'intégration africaine",
                'shortcut' => 'DGAIA',
                'description' => "S'occupe des questions liées à l'integration africaine"
             ],
            [
                'name' => "Directeur général de l'agence guinéenne de coopération technique",
                'shortcut' => 'DGAGCT',
                'description' => "S'occupe de la coopération technique"
             ],
                        [
                'name' => "Directeur général adjoint de l'agence guinéenne de coopération technique",
                'shortcut' => 'DGAAGCT',
                'description' => "S'occupe de la coopération technique"
             ],
            [
                'name' => 'Conseiller économique',
                'shortcut' => 'CE',
                'description' => "Chargé de donner des conseils économiques"
             ],
            [
                'name' => 'Chef division des affaires administrative',
                'shortcut' => 'CDAD',
                'description' => "S'occupe des affaires administratives"
             ],
            [
                'name' => 'Chef division RH',
                'shortcut' => 'DRH',
                'description' => "S'occuppe de la gestion des ressources humaines"
             ],
            [
                'name' => 'Directeur général des Organisations internationales',
                'shortcut' => 'DGOI',
                'description' => "S'occupe des questions liées aux organisations internationales"
             ],
            [
                'name' => 'Directeur général adjoint des Organisations internationales',
                'shortcut' => 'DGAOI',
                'description' =>  "S'occupe des questions liées aux organisations internationales"
             ],
                        [
                'name' => "Directrice général des services de l'ordonnateur national du Fonds Européen pour le développement",
                'shortcut' => 'DGSENOFED',
                'description' => "S'occupe du fonds européen"
             ],
                        [
                'name' => "Directrice général adjoint des services de l'ordonnateur national du Fonds Européen pour le développement",
                'shortcut' => 'DGASENOFED',
                'description' => "S'occupe du fonds européen"
             ],
            [
                'name' => 'Chef de Cabinet',
                'shortcut' => 'CBT',
                'description' => "recueille des informations susceptibles d'intéresser les acteurs stratégiques du monde politique"
             ],
        );

        foreach ($list as $key => $values) {
            // Création d'un type de congé
            $mainFunction = new MainFunction();
            $mainFunction->setName($values['name'])
                    ->setShortcut($values['shortcut'])
                    ->setDescription($values['description']);

            $manager->persist($mainFunction);
            $manager->flush();

            $this->addReference('mainFunction_' . $key, $mainFunction);
        }
    }
}