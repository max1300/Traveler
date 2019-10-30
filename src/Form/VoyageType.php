<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Entity\Destinations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('texte')
            ->add('voyage', EntityType::class,[
                'label' => 'Destinations',
                'class' => Destinations::class,
                'choice_label'=> 'ville',
            ])
            ->add('photos', FileType::class,[
                'mapped' => false,
                'multiple' => true,
                'attr'     => [
                    'accept' => 'image/*',
                    'multiple' => 'multiple'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
