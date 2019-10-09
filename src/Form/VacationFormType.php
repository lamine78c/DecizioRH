<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\VacationType;

class VacationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period')
            ->add('win')
            ->add('spent')
            ->add('startAt')
            ->add('endAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user', EntityType::class, array(
        		'class' => User::class,
        		'choice_label' => 'firstName',
            ))  
            ->add('vacationType', EntityType::class, array(
        		'class' => VacationType::class,
        		'choice_label' => 'name',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}
