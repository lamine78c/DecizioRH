<?php

namespace App\Form;

use App\Entity\Entity;
use App\Entity\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité',
                'choices' => ['M.' => 'homme', 'Mme' => 'femme']
            ])
            ->add('firstname', TextType::class, ['label' => 'Prenom'])
            ->add('lastname', TextType::class, ['label' => 'NOM'])
            ->add('matricule', TextType::class, ['label' => 'N° Matricule'])
            ->add('email', EmailType::class, ['label' => 'Adresse mail'])
            ->add('phone1', TextType::class, ['label' => 'N° Téléphone 1'])
            ->add('phone2', TextType::class, ['label' => 'N° Téléphone 2'])
            ->add('entity', EntityType::class, [
                'class' => Entity::class,
                'choice_label' => 'name',
                'label' => 'Département'
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
