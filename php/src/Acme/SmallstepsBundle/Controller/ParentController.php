<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\SmallstepsBundle\Entity\Child;
use Acme\SmallstepsBundle\Form\ChildType;
use Acme\SmallstepsBundle\Entity\User;
use Acme\SmallstepsBundle\Form\UserType;
use Acme\SmallstepsBundle\Entity\BookingDetail;
use Acme\SmallstepsBundle\Entity\Booking;
use Acme\SmallstepsBundle\Form\BookingType;
use Acme\SmallstepsBundle\Utility\Days;

class ParentController extends Controller {

    /**
     * Creates a new Child entity.
     *
     */
    public function createChildAction(Request $request) {
        $entity = new Child();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setParent($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('view_children', array('id' => $entity->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:Parent:newChild.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Child entity.
     *
     * @param Child $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Child $entity) {
        $form = $this->createForm(new ChildType(), $entity, array(
            'action' => $this->generateUrl('add_child'),
            'method' => 'POST',
        ));



        if ($this->getUser()->getRoles() === array('ROLE_USER')) {
            $form->remove('parent');
        }

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Child entity.
     *
     */
    public function newAction() {
        $entity = new Child();
        $form = $this->createCreateForm($entity);

        return $this->render('AcmeSmallstepsBundle:Parent:newChild.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Child entity.
     *
     */
    public function editChildAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Child entity.');
        }

        $editForm = $this->createEditForm($entity);


        return $this->render('AcmeSmallstepsBundle:Parent:editChild.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Child entity.
     *
     * @param Child $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Child $entity) {
        $form = $this->createForm(new ChildType(), $entity, array(
            'action' => $this->generateUrl('child_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->remove('parent');
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Child entity.
     *
     */
    public function updateChildAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Child entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edit_child', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:Parent:editChild.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function viewChildrenAction() {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();



        $entities = $em->getRepository('AcmeSmallstepsBundle:Child')->findAllByParentId($id);

        return $this->render('AcmeSmallstepsBundle:Parent:indexChild.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Lists all Booking entities.
     *
     */
    public function viewBookingAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSmallstepsBundle:Booking')->findAll();

        return $this->render('AcmeSmallstepsBundle:Parent:indexBooking.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Booking entity.
     *
     */
    public function createBookingAction(Request $request) {
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

            return $this->redirect($this->generateUrl('show_booking', array('id' => $booking->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:Parent:daycare.html.twig', array(
                    'booking' => $booking,
                    'form' => $form->createView(),
                     'weekNum' => $weekNum,
                     'week' => $week,
        ));
    }

    /**
     * Creates a form to create a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateBookingForm(Booking $entity) {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('create_booking'),
            'method' => 'POST',
        ));

       

        return $form;
    }

    /**
     * Displays a form to create a new Booking entity.
     *
     */
    public function newBookingAction() {
        $booking = new Booking();
        $days = new Days();
     
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

        return $this->render('AcmeSmallstepsBundle:Parent:daycare.html.twig', array(
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
    public function showBookingAction() {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }
       
        $bookingDetail = $entity[0]->getBookingDetail();
               // ->get('BookingDetail');
        

        return $this->render('AcmeSmallstepsBundle:Parent:showBooking.html.twig', array(
                    'entity' => $entity,
                     'bookingDetail' => $bookingDetail,
        ));
    }

    /**
     * Displays a form to edit an existing Booking entity.
     *
     */
    public function editBookingAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $editForm = $this->createEditBookingForm($entity);


        return $this->render('AcmeSmallstepsBundle:Parent:editBooking.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditBookingForm(Booking $entity) {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('update_booking', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Booking entity.
     *
     */
    public function updateBookingAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_Booking_edit', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:Booking:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function indexParentAction() {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);
        // $id = $entity->getId();         

        return $this->render('AcmeSmallstepsBundle:Parent:indexParent.html.twig', array(
                    'entity' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editParentAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditParentForm($entity);


        return $this->render('AcmeSmallstepsBundle:Parent:editParent.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditParentForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('view_parent', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->remove('password');

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateParentAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }


        $editForm = $this->createEditParentForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edit_parent', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:Parent:editParent.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
