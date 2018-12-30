<?php

namespace KS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class BooksType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
        ->add('content')
        ->add('numero')
        ->add('nbpages')
        ->add('internetPrice')
        ->add('physicalPrice')
        ->add('amazonLink')
        ->add('amazonApercu')
        ->add('isbn')
        ->add('active', CheckboxType::class)
        ->add('image', ImagesType::class)
->add('category', EntityType::class, array('class'          => 'KSBlogBundle:Category',
                                           'choice_label'   => 'name',
                                           'multiple'       => false))
->add('saga', EntityType::class, array('class'          => 'KSBlogBundle:Sagas',
                                       'choice_label'   => 'name',
                                       'multiple'       => false));
    }
    

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KS\BlogBundle\Entity\Books'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ks_blogbundle_books';
    }


}
