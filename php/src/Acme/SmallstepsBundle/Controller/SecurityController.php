<?php

namespace Acme\SmallstepsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Acme\SmallstepsBundle\Entity\User;
use Acme\SmallstepsBundle\Form\UserType;

class SecurityController extends Controller {

    public function loginAction(Request $request) {
        $session = $this->getRequest()->getSession();


// get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('AcmeSmallstepsBundle:Security:login.html.twig', array(
// last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
        ));
    }

    public function createAction(Request $request) {
        $entity = new User();
        $form = $this->createCreateForm($entity);

        $factory = $this->get('security.encoder_factory');

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
            $em->flush();

            $message = \Swift_Message::newInstance()
                    ->setSubject('Smallsteps nursery registration')
                    ->setFrom('pekuria25@gmail.com')
                    ->setTo($entity->getEmail())
                    ->setBody(
                    $this->renderView(
                            'AcmeSmallstepsBundle:Templates:registration.html.twig', array(
                        'subject' => 'smallsteps nursery registration',
                        'username' => $entity->getUsername(),
                        'password' => $plainPassword,
                        'app_name' => 'smallsteps day nursery')));

            $this->get('mailer')->send($message);


            return $this->redirect($this->generateUrl('login'));
        }
        return $this->render('AcmeSmallstepsBundle:Security:register.html.twig', array(
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
            'action' => $this->generateUrl('register_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function registerAction() {
        $entity = new User();
        $form = $this->createCreateForm($entity);

        return $this->render('AcmeSmallstepsBundle:Security:register.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function indexAction() {

        if (array("ROLE_USER") === $this->getUser()->getRoles()) {
            $id = $this->getUser()->getId();

            return $this->redirect($this->generateUrl('view_parent', array('id' => $id)));
        } else {

            return $this->redirect($this->generateUrl('Admin_User'));
        }
    }

    public function forgotPasswordAction() {
        return $this->render('AcmeSmallstepsBundle:Security:forgotPassword.html.twig');
    }

    public function resetPasswordAction(Request $request) {
        

        $form = $this->createFormBuilder()
                ->add('password2', 'password', array('label' => 'old_password'))
                ->add('password', 'repeated', array(
                    'first_name' => 'password',
                    'second_name' => 'confirm',
                    'type' => 'password',
                    'invalid_message' => 'The password does not match'))
                ->add('Submit', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            var_dump($form->getData());
        }

       
        

        return $this->render('AcmeSmallstepsBundle:Security:resetPassword.html.twig',
                array('form' => $form->createView(),
                    ));
    }

}
