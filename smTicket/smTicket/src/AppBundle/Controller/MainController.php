<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Evenement;

use AdminBundle\Form\evenementType;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\newsletter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use UserBundle\Entity\User;
use AppBundle\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller {

    public function accueilAction() {

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("AdminBundle:Evenement")->findAllEvenementValide();

       /* $id = $em->getRepository("AdminBundle:Evenement")->findOneBy(array('id' => $evenement->getId()));
        $mintarif = $em->getRepository('AdminBundle:Classebillet')->nbreMinTarifById($id);*/


        $mintarif = $em->getRepository('AdminBundle:Classebillet')->NombreTarifMin();

        $villes =$em->getRepository("AdminBundle:Evenement")->FindEventVille();

        $eventAll = $em->getRepository("AdminBundle:Evenement")->findAll();

        $bestevent = $em->getRepository("AdminBundle:Evenement")->findbest();
        $categories = $em->getRepository("AppBundle:Categorie")->findAll();
        $eventsCount = $em->getRepository("AdminBundle:Evenement")->countAllEvents();
        $usersCount = $em->getRepository("UserBundle:User")->countAllUsers();
        $CountClasseBillet = $em->getRepository("AdminBundle:Classebillet")->countAllClasseBillets();

        $request = $this->getRequest();
       $keyword=$request->query->get("Keyword", "all   ");
        $categorie=$request->query->get("categorie", "all");
        $ville=$request->query->get("ville", "all");
        $lieu=$request->query->get("lieu","all");

        $event = $em->getRepository("AdminBundle:Evenement")->chercherEvenement($keyword, $categorie, $ville, $lieu);
        return $this->render('AppBundle::accueil.html.twig', array(
            "evenement" => $evenement,
            "categories" => $categories,
            "event" =>$event,
            "keyword"=> $keyword,
            "eventAll"=>$eventAll,
            "bestevent"=>$bestevent,
            "ville"=>$ville,
            "eventsCount"=>$eventsCount,
            "usersCount"=>$usersCount,
            "CountClasseBillet"=>$CountClasseBillet,
            'villes' => $villes,
            'mintarif'=>$mintarif
        ));
    }



    public function listeDesEvenementAction() {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $evenement = $em->getRepository("AdminBundle:Evenement")->findAllEvenementValide();
        $categories = $em->getRepository("AppBundle:Categorie")->findAll();

        $lieux = $em->getRepository("AdminBundle:Evenement")->FindEventLieux();
        $villes =$em->getRepository("AdminBundle:Evenement")->FindEventVille();
        $MinTarif = $em->getRepository('AdminBundle:Classebillet')->nbreMinTarif();


        $request = $this->getRequest();
        $keyword=$request->query->get("Keyword", "all");
        $categorie=$request->query->get("categorie", "all");
        $ville=$request->query->get("ville", "all");
        $lieu=$request->query->get("lieu","all");

        $event = $em->getRepository("AdminBundle:Evenement")->chercherEvenement($keyword, $categorie, $ville, $lieu);

        $evenement = $this->get('knp_paginator')->paginate(
            $event ,$request->query->get('page', 1)/* page number */, 3/* limit per page */

        );
        return $this->render('AppBundle::listeDesEvenement.html.twig', array(
            "evenement" => $evenement,
            "Keyword"=>$keyword,
            "categories"=>$categories,
            "event"=>$event,
            "ville"=>$ville,
            "lieu"=>$lieu,
            "lieux"=>$lieux,
            "villes"=>$villes,
            "MinTarif" =>$MinTarif,
        ));
    }




    public function detailsAction($id) {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AdminBundle:Evenement')->find($id);
        $mintarif = $em->getRepository('AdminBundle:Classebillet')->nbreMinTarifById($id);
        $eventAll = $em->getRepository("AdminBundle:Evenement")->findAll();
        $commentaire = $this->getDoctrine()
            ->getRepository('AppBundle:Commentaire')
            ->findBy(['evenement'=> $id]);

        $classebillet = $this->getDoctrine()
            ->getRepository('AdminBundle:Classebillet')
            ->findBy(['evenement'=> $id]);

        $com = new Commentaire();
        $evenement = $this->getDoctrine()->getRepository('AdminBundle:Evenement')->find($id);
        $form = $this ->createForm(new CommentaireType(), $com);


        $request= $this->getRequest();
        if($request->isMethod('post')){
            $form -> bind($request);
            if($form->isValid()){
                $com= $form->getData();
                $com->setDateCreationCommentaire(new \Datetime());
                $com->setEvenement($evenement);

                $com->setUsercoment($this->getUser());
                $em= $this ->getDoctrine()->getManager();
                $em->persist($com);
                $em->flush();
                return $this->redirectToRoute('details', array(
                    'id' => $id));}}
        return $this->render('AppBundle::details.html.twig', array("eventAll"=>$eventAll,"mintarif"=>$mintarif,"event" => $event , 'form'=>$form->createView(),'commentaire'=>$commentaire,"classebillet"=>$classebillet  ));
    }



    public function sellticketAction() {

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("AdminBundle:Evenement")->findAllEvenementValide();





        $temoignage = $em->getRepository("ClientBundle:temoignage")->findAll();


        return $this->render('AppBundle::sellticket.html.twig',array("temoignage"=>$temoignage, "evenement"=>$evenement));
    }

    public function contactAction() {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        return $this->render('AppBundle::contact.html.twig');
    }

    public function aproposAction() {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }
        return $this->render('AppBundle::apropos.html.twig');
    }









}
