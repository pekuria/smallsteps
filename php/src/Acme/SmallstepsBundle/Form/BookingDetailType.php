<?php

namespace Acme\SmallstepsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingDetailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookedDate', 'date', array('widget' => 'single_text',
                    'format' => 'dd-MM-yyyy', 'read_only' => 'true'))
            ->add('breakfastClub')
            ->add('afterdayClub')           
            ->add('dayslot', 'entity', array('class' => 'Acme\SmallstepsBundle\Entity\Timeslot',
                 'property' => 'name'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\SmallstepsBundle\Entity\BookingDetail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_smallstepsbundle_bookingdetail';
    }
}
