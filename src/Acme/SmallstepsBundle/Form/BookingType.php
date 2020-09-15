<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('bookingDate')
           // ->add('status')
            ->add('child', 'entity', array('class' => 'App\Entity\Child',
                    'property' => 'firstname'));
           
        
        $builder->add('bookingDetail', 'collection', array('type' => new BookingDetailType(),
            'by_reference' => false));        
       
        
       
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Booking'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_smallstepsbundle_booking';
    }
}
