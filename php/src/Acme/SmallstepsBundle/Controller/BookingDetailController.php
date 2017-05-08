<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\SmallstepsBundle\Entity\BookingDetail;
use Acme\SmallstepsBundle\Form\BookingDetailType;

/**
 * BookingDetail controller.
 *
 * @Route("/admin_booking")
 */
class BookingDetailController extends Controller
{

    /**
     * Lists all BookingDetail entities.
     *
     * @Route("/", name="admin_booking")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSmallstepsBundle:BookingDetail')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BookingDetail entity.
     *
     * @Route("/", name="admin_booking_create")
     * @Method("POST")
     * @Template("AcmeSmallstepsBundle:BookingDetail:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BookingDetail();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_booking_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BookingDetail entity.
     *
     * @param BookingDetail $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BookingDetail $entity)
    {
        $form = $this->createForm(new BookingDetailType(), $entity, array(
            'action' => $this->generateUrl('admin_booking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BookingDetail entity.
     *
     * @Route("/new", name="admin_booking_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BookingDetail();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BookingDetail entity.
     *
     * @Route("/{id}", name="admin_booking_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:BookingDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookingDetail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BookingDetail entity.
     *
     * @Route("/{id}/edit", name="admin_booking_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:BookingDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookingDetail entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a BookingDetail entity.
    *
    * @param BookingDetail $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BookingDetail $entity)
    {
        $form = $this->createForm(new BookingDetailType(), $entity, array(
            'action' => $this->generateUrl('admin_booking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BookingDetail entity.
     *
     * @Route("/{id}", name="admin_booking_update")
     * @Method("PUT")
     * @Template("AcmeSmallstepsBundle:BookingDetail:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:BookingDetail')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookingDetail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_booking_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BookingDetail entity.
     *
     * @Route("/{id}", name="admin_booking_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSmallstepsBundle:BookingDetail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BookingDetail entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_booking'));
    }

    /**
     * Creates a form to delete a BookingDetail entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_booking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
