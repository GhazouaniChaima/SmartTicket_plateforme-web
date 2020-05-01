<?php

namespace UserBundle\Controller;
use UserBundle\Form\Type\RegistrationFormType;
use UserBundle\Form\UserType;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $role = $user->getRoles()[0];
        if ($role==="ROLE_USER"){
            return new RedirectResponse($this->generateUrl('client'));
        } else {
            return new RedirectResponse($this->generateUrl('admin'));
        }
    }





}


