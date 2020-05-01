<?php

namespace ClientBundle\Controller;

use AdminBundle\Form\evenementType;
use AdminBundle\Form\ClassebilletType;
use AdminBundle\Entity\Evenement;
use AdminBundle\Entity\Classebillet;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\RedirectResponse;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
       public function ajouterEvenementEtCatBilletAction(Request $request) {
           if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
               return new RedirectResponse($this->generateUrl('admin'));
           }

        $evenement=new evenement();
         $form=$this->createForm(new evenementType,$evenement);

        $form->handleRequest($request);
        if($form->isValid()){
            $event = $form->getData();
            $event->setDateCreationEvenement(new \Datetime());
            $event->setUser($this->getUser());
            $event->setVues(0);


            $em=$this->getDoctrine()->getManager();
            $em->persist($evenement);
            foreach($evenement->getClassebillets() as $Classebillet)
            {
                $Classebillet->setQntStock($Classebillet->getQntbillet());
                $em->persist($Classebillet);
            }


            $em->flush();
            $this->addFlash("ajout", 1);
            return $this->redirectToRoute('consulterEvenementOrg');

            
        }




        return $this->render('ClientBundle:Evenement:ajouterEvenementEtCatBillet.html.twig', array('form'=>$form->createView()));
    }





    function consulterEvenementEtCatBilletAction() {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $classebillet = $em->getRepository('AdminBundle:Classebillet')->findAll();


        $listeEvenemnt = $em->getRepository('AdminBundle:Evenement')->getevenementsbyuser($this->getUser());

        $evenement = $this->get('knp_paginator')->paginate(
            $listeEvenemnt  ,$request->query->get('page', 1)/* page number */, 3/* limit per page */);
        return $this->render('ClientBundle:Evenement:consulterEvenement.html.twig', array("event" => $evenement, "classebillet"=>$classebillet));
    }




    function supprimerEvenementEtCatBilletAction($id) {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("AdminBundle:Evenement")->find($id);
        $em->remove($evenement);
        $em->flush();
        $this->addFlash("suppression", 1);return $this->redirectToRoute('consulterEvenementOrg');
    }



    public function modifierEvenementEtCatBilletAction($id) {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("AdminBundle:Evenement")->find($id);

        $form = $this->createForm(new evenementType, $evenement);
        return $this->render('ClientBundle:Evenement:modifierEvenementClient.html.twig', array('form' => $form->createView(), 'evenement' => $evenement));
    }



    public function sauvgardermodificationEtCatBilletAction($id) {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("AdminBundle:Evenement")->find($id);
        $form = $this->createForm(new evenementType, $evenement);
        $request = $this->get('request');
        //$form->handleRequest($request);
        $form->bind($request);
        dump($evenement->getTitreEvenement());die;
//dump($form->get('file'));die;
        //$evenement->setFile($form->get('file'));


        /*$evenement_old->setTitreEvenement($evenement_new->getTitreEvenement());
        $evenement_old->setLieuEvenement($evenement_new->getLieuEvenement());
        $evenement_old->setDateDebutEvenement($evenement_new->getDateDebutEvenement());

        $evenement_old->setDateFinEvenement($evenement_new->getDateFinEvenement());
        $evenement_old->setHeureDebutEvenement($evenement_new->getHeureDebutEvenement());
        $evenement_old->setHeureFinEvenement($evenement_new->getHeureFinEvenement());
        $evenement_old->setDescriptionEvenement($evenement_new->getDescriptionEvenement());*/

$evenement->preUpload();
$evenement->upload();
        //$em->persist($evenement);

        $em->flush();
        $this->addFlash("modification", 1);
        return $this->redirectToRoute('consulterEvenementOrg');
    }

    public function vuEvenementAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository("AdminBundle:Evenement")->find($id);

        $evenement->setVues($evenement->getVues()+1);
        $em->persist($evenement);
        $em->flush();


        return $this->redirectToRoute('details',array('id' =>$id));
    }


    public function consulterStatistqueAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $countEventsMusiqueByuser = $em->getRepository('AdminBundle:Evenement')->countEventsMusiqueByuser($this->getUser());
        $countEventsCinemaByuser = $em->getRepository('AdminBundle:Evenement')->countEventsCinemaByuser($this->getUser());
        $countEventsTheatreByuser = $em->getRepository('AdminBundle:Evenement')->countEventsTheatreByuser($this->getUser());
        $countEventsSportByUser = $em->getRepository('AdminBundle:Evenement')->countEventsSportByUser($this->getUser());
        $countEventsConcertByUser = $em->getRepository('AdminBundle:Evenement')->countEventsConcertByUser($this->getUser());
        $countEventsFestivalsByUser = $em->getRepository('AdminBundle:Evenement')->countEventsFestivalsByUser($this->getUser());

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Nombre des événements par catégorie');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('Musique', (float)$countEventsMusiqueByuser),
            array('Cinéma', (float)$countEventsCinemaByuser),
            array('Théatre', (float)$countEventsTheatreByuser),
            array('Festivals', (float)$countEventsConcertByUser),
            array('Sport', (float)$countEventsSportByUser),
            array('Concert', (float)$countEventsFestivalsByUser),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));


        return $this->render('ClientBundle:Evenement:consulterStatistque.html.twig', array('chart' => $ob));

    }








    }
    

    

