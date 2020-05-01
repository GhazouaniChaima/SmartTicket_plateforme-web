<?php

namespace AdminBundle\Controller;
use AppBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommantaireAdminController extends Controller
{
    public function listeCommantaireAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listecommantaires = $em->getRepository('AppBundle:Commentaire')->findAllorder();
        $commantaires= $this->get('knp_paginator')->paginate(
            $listecommantaires  ,$request->query->get('page', 1)/* page number */, 5/* limit per page */);
        return $this->render('AdminBundle:Commantaire:listeCommantaire.html.tiwg',
            array("coms" => $commantaires));
    }

    function supprimerCommantaireAction($id) {
        $em = $this->getDoctrine()->getManager();
        $com = $em->getRepository("AppBundle:Commentaire")->find($id);
        $em->remove($com);
        $em->flush();
        $this->addFlash("suppression", 1);
        return $this->redirectToRoute('listeCommantaire');
    }
}
