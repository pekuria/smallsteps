<?php

namespace Acme\SmallstepsBundle\Form;

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
            ->add('child', 'entity', array('class' => 'Acme\SmallstepsBundle\Entity\Child',
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
            'data_class' => 'Acme\SmallstepsBundle\Entity\Booking'
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
