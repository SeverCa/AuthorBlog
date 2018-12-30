<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChroniquesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'attr' => array(
                'placeholder' => 'Titre du lien'
            )
        ))
        ->add('url', TextType::class, array(
            'attr' => array(
                'placeholder' => 'URL du lien http://...'
            )
        ))
        ->add('saga', EntityType::class, array(
                                               'class'          => 'KSBlogBundle:Sagas',
                                               'choice_label'   => 'name',
                                               'empty_data'     => null,
                                               'required'       => false,
                                               'multiple'       => false))
        ->add('book', EntityType::class, array('class'          => 'KSBlogBundle:Books',
                                               'choice_label'   => 'name',
                                               'empty_data'     => null,
                                               'required'       => false,
                                               'multiple'       => false))
        ->add('novel', EntityType::class, array('class'          => 'KSBlogBundle:Novels',
                                               'choice_label'   => 'name',
                                               'empty_data'     => null,
                                               'required'       => false,
                                               'multiple'       => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Chroniques'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_chroniques';
    }


}
