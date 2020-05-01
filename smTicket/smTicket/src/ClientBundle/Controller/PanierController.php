<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Classebillet;
use ClientBundle\Entity\Commande;
use ClientBundle\Entity\ElementCmd;
use ClientBundle\Form\ElementCmdType;
use ClientBundle\Form\CommandeType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{

    public function ajouterElemPanierAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', array());
        }
        $panier = $session->get('panier');

        $quantities = $request->request->get('quantite');
        foreach ($quantities as $id => $quantity) {
            if(isset($panier[$id])){
            $panier[$id] +=  $quantity[0];
            }else{
                $panier[$id] =  $quantity[0];
            }
        }

        $session->set('panier', $panier);


        return new RedirectResponse($this->generateUrl('panier'));
    }




    public function supprimerElemPanierAction($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        if (array_key_exists($id, $panier)) {
            unset($panier[$id]);
            $session->set('panier', $panier);
        }

        $this->addFlash("suppression", 1);
        return $this->redirect($this->generateUrl('panier'));
    }

    public function panierAction()
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return new RedirectResponse($this->generateUrl('admin'));
        }

        $session = $this->getRequest()->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', array());
        }
        //var_dump($session->get('panier'));
        //die();

        $em = $this->getDoctrine()->getManager();
        $billets = $em->getRepository("AdminBundle:Classebillet")->findArray(array_keys($session->get('panier')));
        return $this->render('ClientBundle:Panier:panier.html.twig', array('billets' => $billets, 'panier' => $session->get('panier')));



    }



}
