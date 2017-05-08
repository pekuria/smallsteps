<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\SmallstepsBundle\Entity\Child;
use Acme\SmallstepsBundle\Form\ChildType;

/**
 * Child controller.
 *
 */
class ChildController extends Controller
{

    /**
     * Lists all Child entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSmallstepsBundle:Child')->findAll();

        return $this->render('AcmeSmallstepsBundle:Child:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Child entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Child();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_Child_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:Child:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Child entity.
     *
     * @param Child $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Child $entity)
    {
        $form = $this->createForm(new ChildType(), $entity, array(
            'action' => $this->generateUrl('Admin_Child_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Child entity.
     *
     */
    public function newAction()
    {
        $entity = new Child();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmeSmallstepsBundle:Child:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Child entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Child entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:Child:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Child entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Child entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:Child:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Child entity.
    *
    * @param Child $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Child $entity)
    {
        $form = $this->createForm(new ChildType(), $entity, array(
            'action' => $this->generateUrl('Admin_Child_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Child entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Child entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_Child_edit', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:Child:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Child entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSmallstepsBundle:Child')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Child entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Admin_Child'));
    }

    /**
     * Creates a form to delete a Child entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_Child_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
