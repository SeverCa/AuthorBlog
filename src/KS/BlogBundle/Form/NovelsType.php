<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NovelsType extends AbstractType
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
                ->add('content', CKEditorType::class)
                ->add('aside', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Résumé'
                    )
                ))
                ->add('image', ImagesType::class)
                ->add('amazonLink', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Lien Amazon'
                    )
                ))
                ->add('pandaLink', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Lien IndéPanda'
                    )
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Novels'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_novels';
    }


}
