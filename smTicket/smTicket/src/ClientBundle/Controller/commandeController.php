<?php

namespace ClientBundle\Controller;
use ClientBundle\Entity\Commande;
use ClientBundle\Entity\ElementCmd;
use AdminBundle\Entity\Classebillet;
use ClientBundle\Entity\Ticket;
use ClientBundle\Form\CommandeType;
use ClientBundle\Form\ValidationCommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;


class commandeController extends Controller
{
    public function validerCommandeAction(Request $request) {
        $err=0;
        $session = $this->getRequest()->getSession();
        $form = $this->createForm(new ValidationCommandeType());
        if($request->getMethod() == 'POST') {

            $username = $request->request->get('validation_commande')['username'];
            $email = $request->request->get('validation_commande')['email'];
            $tel = $request->request->get('validation_commande')['tel'];

            if ($username != $this->getUser()->getUsername()) {
                $form->addError(new FormError('error message username'));
            } elseif ($email != $this->getUser()->getEmail()) {
                $form->addError(new FormError('error message email'));
            } elseif ($tel != $this->getUser()->getTel()) {
                $form->addError(new FormError('error message tel'));
            }


            $err=count($form->getErrors());


            if (count($form->getErrors()) == 0) {
                $em = $this->getDoctrine()->getManager();
                $commande = new Commande();
                $commande->setReference(uniqid());
                $commande->setPayer(0);
                $commande->setDate(new \Datetime());
                $commande->setUsercomd($this->getUser());
                $em->persist($commande);

                $panier = $session->get('panier');
                if ($panier) {

                    $ClasseBillets = $em->getRepository("AdminBundle:Classebillet")->findArray(array_keys($panier));
                    foreach ($ClasseBillets as $ClasseBillet) {

                        $qnt= $panier[$ClasseBillet->getId()];
                        if(isset($qnt) && $qnt != '') {
                            $elementCmd = new ElementCmd();
                            $elementCmd->setQuantite($panier[$ClasseBillet->getId()]);
                            $elementCmd->setCommande($commande);
                            $elementCmd->setClassebillet($ClasseBillet);
                            $em->persist($elementCmd);

                            $ClasseBillet->setQntStock($ClasseBillet->getQntStock() - $qnt);                        }
                    }
                }
                $em->flush();
                $em->refresh($commande);
                $session->remove('panier');

                return $this->redirect($this->generateUrl('payerCommande', array('id' => $commande->getId())));
            }
        }
        return $this->render('ClientBundle:commande:validerCommande.html.twig', array(
            'form' => $form->createView(),"err"=>$err
        ));
    }






    public function payerCommandeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository("ClientBundle:Commande")->find($id);
;
        return $this->render('ClientBundle:commande:payerCommande.html.twig', array('commande' => $commande));
    }

    public function paiementAction($id) {
        $em = $this->getDoctrine()->getManager();

        $commande = $em->getRepository("ClientBundle:Commande")->find($id);
        if (!$commande || $commande->getPayer() == 1) {
            throw $this->createNotFoundException('la commande n\'existe pas ');
        }
        $commande->setPayer(1);
        $commande->setDate(new \Datetime());
        $em->persist($commande);
        $em->flush();

        foreach ($commande->getElementCmd() as $ec)
        {
            for($i=0;$i<$ec->getQuantite();$i++){
                $ticket=new Ticket();
                $ticket->setReference(uniqid());
                $ticket->getDateGeneration(new \Datetime());
                $ticket->setStatus(0);
                $ticket->setElementcmd($ec);
                $em->persist($ticket);
            }
        }

        return $this->redirect($this->generateUrl('recu', array('id' => $commande->getId())));
    }

    public function recuAction() {


        return $this->render('ClientBundle:commande:recu.html.twig');
    }

    public function consulterCommandeAction() {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $listecommande = $em->getRepository('ClientBundle:Commande')->getcommandebyuser($this->getUser());
        $commande = $this->get('knp_paginator')->paginate(
            $listecommande  ,$request->query->get('page', 1)/* page number */, 5/* limit per page */);

        return $this->render('ClientBundle:commande:consulterCommande.html.twig', array("commande" => $commande));

    }

}
