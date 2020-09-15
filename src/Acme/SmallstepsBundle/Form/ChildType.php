<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChildType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('parent', 'entity', array('class' => 'App\Entity\User',
                    'property' => 'firstname'))
                ->add('firstname')
                ->add('lastname')
                ->add('dob')
                ->add('nhsNo')
                ->add('school', 'entity', array('class' => 'App\Entity\School',
                    'property' => 'name'))
                ->add('room', 'entity', array('class' => 'App\Entity\Room',
                    'property' => 'name'))
                ->add('additional');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Child'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'acme_smallstepsbundle_child';
    }

}
