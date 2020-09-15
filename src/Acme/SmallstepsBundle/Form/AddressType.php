<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('id')
                ->add('houseNo')
                ->add('streetName')
                ->add('city')
                ->add('county')
                ->add('postCode')
                ->add('id')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'acme_smallstepsbundle_address';
    }

}
