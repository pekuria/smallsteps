<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\SmallstepsBundle\Entity\User;
use Acme\SmallstepsBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    /**
     * Lists all User entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeSmallstepsBundle:User')->findAll();
        
                       
        return $this->render('AcmeSmallstepsBundle:User:index.html.twig', array(
                    'entities' => $entities,
        ));
         
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new User();
        $factory = $this->get('security.encoder_factory');
        $form = $this->createCreateForm($entity);



        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encoder = $factory->getEncoder($entity);
            $plainPassword = $entity->getPassword();
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setPassword($password);
            $entity->setActive(TRUE);
            $entity->setAdmin(FALSE);
            $entity->setEnabled($entity->getActive());
            $em->persist($entity);
            
            
        $message = \Swift_Message::newInstace()
                ->setSubject('Smallsteps nursery registration')
                ->setFrom('pekuria25@gmail.com')
                ->setTo($entity->getEmail())
                ->setBody(
                        $this->renderView(
                          'AcmeSmallstepBundle:Templates:registration..html.twig',
                                array('subject'=> 'smallsteps nursery registration',
                                    'username' => $entity->getUsername(),
                                    'password' => $plainPassword)));
        
        $em->flush();
        $this->get('mailer')->send($message);
                

            return $this->redirect($this->generateUrl('Admin_User_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeSmallstepsBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('Admin_User_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction() {
        $entity = new User();
        $form = $this->createCreateForm($entity);

        return $this->render('AcmeSmallstepsBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
              
        $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:User:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
       $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeSmallstepsBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('Admin_User_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('Admin_User_edit', array('id' => $id)));
        }

        return $this->render('AcmeSmallstepsBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSmallstepsBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Admin_User'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('Admin_User_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
