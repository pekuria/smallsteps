<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\SmallstepsBundle\Entity\PaymentMethod;
use Acme\SmallstepsBundle\Form\PaymentMethodType;

/**
 * PaymentMethod controller.
 *
 */
class PaymentMethodController extends Controller
{

    /**
     * Lists all PaymentMethod entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSmallstepsBundle:PaymentMethod')->findAll();

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PaymentMethod entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PaymentMethod();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_PaymentMethod_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PaymentMethod entity.
     *
     * @param PaymentMethod $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PaymentMethod $entity)
    {
        $form = $this->createForm(new PaymentMethodType(), $entity, array(
            'action' => $this->generateUrl('Admin_PaymentMethod_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PaymentMethod entity.
     *
     */
    public function newAction()
    {
        $entity = new PaymentMethod();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PaymentMethod entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaymentMethod entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PaymentMethod entity.
    *
    * @param PaymentMethod $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PaymentMethod $entity)
    {
        $form = $this->createForm(new PaymentMethodType(), $entity, array(
            'action' => $this->generateUrl('Admin_PaymentMethod_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PaymentMethod entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:PaymentMethod')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_PaymentMethod_edit', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:PaymentMethod:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PaymentMethod entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSmallstepsBundle:PaymentMethod')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PaymentMethod entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Admin_PaymentMethod'));
    }

    /**
     * Creates a form to delete a PaymentMethod entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_PaymentMethod_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
