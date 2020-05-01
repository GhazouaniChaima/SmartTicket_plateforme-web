<?php

namespace AdminBundle\Controller;
use ClientBundle\Entity\temoignage;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemoignageAdminController extends Controller
{
    public function listeTemoignageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listetemoignage = $em->getRepository('ClientBundle:temoignage')->findAll();
        $temoignages= $this->get('knp_paginator')->paginate(
            $listetemoignage  ,$request->query->get('page', 1)/* page number */, 5/* limit per page */);
        return $this->render('AdminBundle:Temoignage:listeTemoignage.html.twig',
            array("tems" => $temoignages));

    }


    function supprimerTemoignageAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tem = $em->getRepository("ClientBundle:temoignage")->find($id);
        $em->remove($tem);
        $em->flush();
        $this->addFlash("suppression", 1);
        return $this->redirectToRoute('listeTemoignage');
    }
}
