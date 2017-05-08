<?php

namespace Acme\SmallstepsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalHours')
            ->add('amount')
            ->add('status')
            ->add('createdtime')
            ->add('paymentType')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SmallstepsBundle\Entity\Payment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_smallstepsbundle_payment';
    }
}
