<?php

namespace Acme\SmallstepsBundle\Form;

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
                
                ->add('parent', 'entity', array('class' => 'Acme\SmallstepsBundle\Entity\User',
                    'property' => 'firstname'))
                ->add('firstname')
                ->add('lastname')
                ->add('dob')
                ->add('nhsNo')
                ->add('school', 'entity', array('class' => 'Acme\SmallstepsBundle\Entity\School',
                    'property' => 'name'))
                ->add('room', 'entity', array('class' => 'Acme\SmallstepsBundle\Entity\Room',
                    'property' => 'name'))
                ->add('additional');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SmallstepsBundle\Entity\Child'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'acme_smallstepsbundle_child';
    }

}
