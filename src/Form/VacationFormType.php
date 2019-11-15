<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\User;
use App\Entity\VacationType;

class VacationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period', TextType::class)
            ->add('win', TextType::class)
            ->add('spent', TextType::class)
            ->add('startAt', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('endAt', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('expiredAt', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
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
