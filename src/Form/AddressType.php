<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Municipality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street',TextType::class, ['label' => 'Secteur ou BP'])
            ->add('cityArea', TextType::class, ['label' => 'Quartier'])
            ->add('municipality', EntityType::class, [
                'class' => Municipality::class,
                'choice_label' => 'name',
                'label' => 'Commune'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
