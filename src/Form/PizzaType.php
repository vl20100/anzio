<?php

namespace App\Form;

use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('creamBase', CheckboxType::class, [
                "label" => "CreamBase",
                "required" => false
            ])
            ->add('tomatoBase', CheckboxType::class, [
                "label" => "TomatoBase",
                "required" => false
            ])
            ->add('ingredients')
            ->add('prices', CollectionType::class, [
                'entry_type' => PriceType::class,
                'allow_add' => true
            ])
            ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
