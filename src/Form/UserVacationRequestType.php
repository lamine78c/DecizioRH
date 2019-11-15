<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class UserVacationRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userComment', TextareaType::class, [
                'required' => false,
            ])
            ->remove('user')
            ->remove('requestStatus')
            ->remove('managerComment');
    }
    public function getParent()
    {
        return VacationRequestType::class;
    }
}
