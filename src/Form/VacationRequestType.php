<?php

namespace App\Form;

use App\Entity\VacationRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\User;
use App\Entity\VacationType;
use App\Entity\RequestStatus;

class VacationRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userComment', TextareaType::class, [
                'attr' => ['readonly' => true],
                'required' => false,
            ])
            ->add('managerComment', TextareaType::class, [
                'required' => false,
            ])
            ->add('startAt',  DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/mm/yyyy',
                'html5' => false,
            ])
            ->add('endAt',  DateType::class, [
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
            ->add('requestStatus', EntityType::class, array(
        		'class' => RequestStatus::class,
        		'choice_label' => 'name',
            ))
            ->add('startTimeCode', ChoiceType::class, [
                'choices' => ['Matin' => 'matin', 'Soir' => 'soir'],
                'required' => true,
            ])
            ->add('endTimeCode', ChoiceType::class, [
                'choices' => ['Soir' => 'soir', 'Matin' => 'matin'],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VacationRequest::class,
        ]);
    }
}
