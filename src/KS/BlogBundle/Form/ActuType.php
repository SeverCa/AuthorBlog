<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ActuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Nom de l\'évènement'
            )
        ))
        ->add('aside', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Sous-titre'
            )
        ))
        ->add('debut', DateType::class, array(
            'widget' => 'single_text'
        ))
        ->add('end', DateType::class, array(
            'widget' => 'single_text'
        ))
        ->add('tarif', NumberType::class, array(
            'attr' => array(
                'placeholder' => 'Tarif',
                'scale' => 2
            )
        ))
        ->add('city', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Ville'
            )
        ))
        ->add('postalcode', IntegerType::class, array(
            'attr' => array(
                'placeholder' => 'Code postal'
            )
        ))
        ->add('adresse', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Adresse'
            )
        ))
        ->add('website', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Site web'
            )
        ))
        ->add('map', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Lien Google maps'
            )
        ))
        ->add('content', TextAreaType::class, array(
            'attr' => array(
                'placeholder' => 'Description'
            )
        ))
        ->add('image', ImagesType::class, array(
            'attr' => array(
                'placeholder' => 'Affiche'
            )
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Actu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_actu';
    }


}
