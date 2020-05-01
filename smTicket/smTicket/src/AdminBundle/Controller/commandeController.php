<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class commandeController extends Controller
{
    function consulterListeCommandesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listecommandes = $em->getRepository('ClientBundle:Commande')->findAll();
        $cmd = $this->get('knp_paginator')->paginate(
            $listecommandes  ,$request->query->get('page', 1)/* page number */, 10/* limit per page */);
        return $this->render('AdminBundle:commande:consulterListeCommandes.html.twig',
            array("cmd" => $cmd));
    }
}
