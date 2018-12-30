<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PartenariatsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Titre'
                    )
                ))
                ->add('content', TextAreaType::class, array(
            'attr' => array(
                'placeholder' => 'Contenu'
                    )
                ))
                ->add('websitelink', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Site web'
                    )
                ))
                ->add('socialmedialink', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Lien réseau social'
                    )
                ))
                ->add('email', TextType::class, array(
            'attr' => array(
                'placeholder' => 'E-mail'
                    )
                ))
                ->add('image', ImagesType::class)
                ->add('active', CheckboxType::class, array(
                    'label'    => 'visible par les visiteurs',
                    'attr' => array('checked'   => 'checked'),
                    'required' => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Partenariats'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_partenariats';
    }


}
