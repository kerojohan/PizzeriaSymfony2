<?php

namespace Pizzeria\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PizzaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sellingPrice','hidden')
            ->add('ingredients','entity',array(  
                'class' => 'Pizzeria\TestBundle\Entity\Ingredient',
                'expanded' => true,
                'multiple' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pizzeria\TestBundle\Entity\Pizza'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'exoclick_testbundle_pizza';
    }
}
