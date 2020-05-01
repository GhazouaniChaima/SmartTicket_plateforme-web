<?php

namespace AdminBundle\Controller;
use AdminBundle\Entity\ClasseBillet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class classeBilletController extends Controller
{
    function consulterDetailsClasseBilletAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $classebillet = $this->getDoctrine()
            ->getRepository('AdminBundle:Classebillet')
            ->findBy(['evenement'=> $id]);
        $event = $em->getRepository('AdminBundle:Evenement')->find($id);

        return $this->render('AdminBundle:ClasseBillet:consulterClasseBillet.html.twig',
            array("classebillet" => $classebillet, "event"=>$event));
    }
}
