<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\evenementType;
use AdminBundle\Form\ClassebilletType;
use AdminBundle\Entity\Evenement;
use AdminBundle\Entity\Classebillet;
use Ob\HighchartsBundle\Highcharts\Highchart;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    
         function consulterEvenementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listeEvenements = $em->getRepository('AdminBundle:Evenement')->findAllorder();
        $evenement = $this->get('knp_paginator')->paginate(
            $listeEvenements  ,$request->query->get('page', 1)/* page number */, 10/* limit per page */);
        return $this->render('AdminBundle:Evenement:consulterEvenementAll.html.twig',
            array("event" => $evenement));
    }
    



    public function ActiverStatusAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');

        $status = $em->getRepository("AdminBundle:Evenement")->find($id);

        $status->setStatus(1);
        $em->persist($status);
        $em->flush();
        return $this->redirectToRoute('consulterEvenement');
    }

    public function DesactiverStatusAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id=$request->get('id');

        $status = $em->getRepository("AdminBundle:Evenement")->find($id);
        $status->setStatus(0);
        $em->persist($status);
        $em->flush();
        $this->addFlash("réfuser", 1);
        return $this->redirectToRoute('consulterEvenement');
    }






    }
    

    

