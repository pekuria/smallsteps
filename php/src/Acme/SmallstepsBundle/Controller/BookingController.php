<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\SmallstepsBundle\Entity\Booking;
use Acme\SmallstepsBundle\Entity\BookingDetail;
use Acme\SmallstepsBundle\Form\BookingType;
use Acme\SmallstepsBundle\Utility\Days;

/**
 * Booking controller.
 *
 */
class BookingController extends Controller
{

    /**
     * Lists all Booking entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSmallstepsBundle:Booking')->findAll();

        return $this->render('AcmeSmallstepsBundle:Booking:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Booking entity.
     *
     */
    public function createAction(Request $request)
    {
         $booking = new Booking();
        $days = new Days();
        $weekNum = $days->currentWeek();
         if (isset($_GET['weekNum'])) {
            $weekNum = $_GET['weekNum'];
        } else {
            $weekNum = $days->currentWeek();
        }
        
        $week = $days->daysInWeek($weekNum);
       
        
        $bookingDetail1 = new BookingDetail();
        $bookingDetail2 = new BookingDetail();
        $bookingDetail3 = new BookingDetail();
        $bookingDetail4 = new BookingDetail();
        $bookingDetail5 = new BookingDetail();

       $booking->getBookingDetail()->add($bookingDetail1);
       $booking->getBookingDetail()->add($bookingDetail2);
       $booking->getBookingDetail()->add($bookingDetail3);
       $booking->getBookingDetail()->add($bookingDetail4);
       $booking->getBookingDetail()->add($bookingDetail5);        

        $form = $this->createCreateBookingForm($booking);
        $form->handleRequest($request);



        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $booking->setBookingDate(new \DateTime('now') );
            $booking->setStatus(0);
            $booking->setPayment(NULL);
            $booking->setPrice(NULL);
            $em->persist($booking);        
            $em->flush();

            

            return $this->redirect($this->generateUrl('Admin_Booking_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:Booking:new.html.twig', array(
            'entity' => $booking,
                    'form' => $form->createView(),
                    'weekNum' => $weekNum,
                    'week' => $week
        ));
    }

    /**
     * Creates a form to create a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Booking $entity)
    {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('Admin_Booking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Booking entity.
     *
     */
    public function newAction()
    {
         $booking = new Booking();
        $days = new Days();
     
        if (isset($_GET['weekNum'])) {
            $weekNum = $_GET['weekNum'];
        } else {
            $weekNum = $days->currentWeek();
        }
        
        $week = $days->daysInWeek($weekNum);
        $booking = new Booking();
        $bookingDetail1 = new BookingDetail();
        $bookingDetail2 = new BookingDetail();
        $bookingDetail3 = new BookingDetail();
        $bookingDetail4 = new BookingDetail();
        $bookingDetail5 = new BookingDetail();

       $booking->addBookingDetail($bookingDetail1);
       $booking->addBookingDetail($bookingDetail2);
       $booking->addBookingDetail($bookingDetail3);
       $booking->addBookingDetail($bookingDetail4);
       $booking->addBookingDetail($bookingDetail5);
        $form   = $this->createCreateForm($booking);

        return $this->render('AcmeSmallstepsBundle:Booking:new.html.twig', array(
            'entity' => $booking,
                    'form' => $form->createView(),
                    'weekNum' => $weekNum,
                    'week' => $week,
        ));
    }

    /**
     * Finds and displays a Booking entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:Booking:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Booking entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:Booking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Booking entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Booking $entity)
    {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('Admin_Booking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Booking entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_Booking_edit', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:Booking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Booking entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Booking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Admin_Booking'));
    }

    /**
     * Creates a form to delete a Booking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_Booking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
