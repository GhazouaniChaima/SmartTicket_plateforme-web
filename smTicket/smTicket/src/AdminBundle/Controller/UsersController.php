<?php

namespace AdminBundle\Controller;

use UserBundle\Form\Type\RegistrationFormType;


use UserBundle\Entity\User;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function consulterUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listeUsers = $em->getRepository('UserBundle:User')->findAllorder();

        $users = $this->get('knp_paginator')->paginate(
            $listeUsers  ,$request->query->get('page', 1)/* page number */, 5/* limit per page */);
        return $this->render('AdminBundle:Users:consulterUsers.html.twig',
            array("users" => $users));
    }



    public function debloquerUserAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');

        $locked = $em->getRepository("UserBundle:User")->find($id);

        $locked->setLocked("0");
        $em->persist($locked);
        $em->flush();
        $this->addFlash("debloquer", 1);

        return $this->redirectToRoute('consulterUsers');}


    public function bloquerUserAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');

        $locked = $em->getRepository("UserBundle:User")->find($id);
        $locked->setLocked("1");
        $em->persist($locked);
        $em->flush();
        $this->addFlash("bloquer", 1);

        return $this->redirectToRoute('consulterUsers');
    }



    }
    

    

