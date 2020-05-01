<?php

namespace ClientBundle\Controller;

use AdminBundle\Entity\Evenement;
use AdminBundle\Form\evenementType;
use ClientBundle\Entity\temoignage;
use UserBundle\Entity\User;
use ClientBundle\Form\temoignageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class dashboardClientController extends Controller {

    public function dashboardClientAction(Request $request) {

        $tem = new temoignage();
        $form = $this ->createForm(new temoignageType(), $tem);
        $request= $this->getRequest();
        if($request->isMethod('post')){
            $form -> bind($request);
            if($form->isValid()){
                $tem= $form->getData();
                $tem->setDateCreationtemoignage(new \DateTime());
                $tem->setUsertemg($this->getUser());
                $em= $this ->getDoctrine()->getManager();
                $em->persist($tem);
                $em->flush();
                return $this->redirectToRoute('sellticket');}}



        return $this->render('ClientBundle::dashboardClient.html.twig', array('form'=>$form->createView()));
    }

   
}
