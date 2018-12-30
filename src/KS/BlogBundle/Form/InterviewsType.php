<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InterviewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('aside', TextType::class, array(
                    'attr' => array(
                    'placeholder' => 'Titre du lien'
                        )
                    ))
                ->add('url', TextType::class, array(
                    'attr' => array(
                    'placeholder' => 'Adresse http://...'
                        )
                    ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Interviews'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_interviews';
    }


}
