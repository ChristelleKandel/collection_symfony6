<?php

namespace App\Form;

use App\Entity\Bar;
use App\Entity\Foo;
use App\Form\BarType;
use App\Form\BuzType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            // Je peux afficher les bars mais je ne peux pas les associer à foo, je dois passer par le form de bar pour faire l'association
            // ->add('bars', EntityType::class, [
            //     'class'=>Bar::class, 
            //     'choice_label'=>'name', 
            //     'label' => 'Nom des bars associés',
            //     // 'expanded' => true,
            //     'multiple' => true,
            //    ])
            // Donc j'utilise les collections à partir des formType des 2 autres auxquels j'ai retiré les add("foo")
            ->add('bars', CollectionType::class, [
                'entry_type'=> BarType::class, 
                'by_reference' => false,
                'allow_add'=> true, 
                'allow_delete' => true,
                'error_bubbling' => false
                ])
            ->add('bazs', CollectionType::class, [
                'entry_type'=> BazType::class, 
                'by_reference' => false,
                'allow_add'=> true, 
                'allow_delete' => true,
                'error_bubbling' => false
                ])
            ->add('buzes', CollectionType::class, [
                'entry_type'=> BuzType::class, 
                'by_reference' => false,
                'allow_add'=> true, 
                'allow_delete' => true,
                'error_bubbling' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Foo::class,
        ]);
    }
}
