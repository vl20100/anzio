<?php

namespace App\Form;

use App\Entity\PizzaOfMonth;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaOfMonthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('creamBase')
            ->add('tomatoBase')
            ->add('active')
            ->add('month', ChoiceType::class, [
                'choices' => [
                    "Janvier" => 1,
                    "Février" => 2,
                    "Mars" => 3,
                    "Avril" => 4,
                    "Mai" => 5,
                    "Juin" => 6,
                    "Juillet" => 7,
                    "Août" => 8,
                    "Septembre" => 9,
                    "Octobre" => 10,
                    "Novembre" => 11,
                    "Décembre" => 12
                ]
            ])
            ->add('year')
            ->add('shop', ChoiceType::class, [
                'choices' => [
                    "Aix-les-Bains" => "Aix-les-Bains",
                    // "La Motte Servolex" => "La Motte Servolex"
                ],
                'multiple' => true
            ])
            ->add('prices', CollectionType::class, [
                'entry_type' => PriceType::class,
                'allow_add' => true
            ])
            ->add('ingredients')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PizzaOfMonth::class,
        ]);
    }
}
