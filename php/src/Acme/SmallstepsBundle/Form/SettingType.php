<?php

namespace Acme\SmallstepsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('allowRegistration')
            ->add('paypalEmail')
            ->add('redirectLocation')
            ->add('appVersion')
            ->add('noOfAttempts')
            ->add('siteName')
            ->add('adminEmail')
            ->add('bankHolidays')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SmallstepsBundle\Entity\Setting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_smallstepsbundle_setting';
    }
}
