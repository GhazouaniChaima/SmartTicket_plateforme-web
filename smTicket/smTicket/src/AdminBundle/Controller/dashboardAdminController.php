<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Evenement;
use AdminBundle\Form\evenementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

class dashboardAdminController extends Controller {

    public function dashboardAdminAction(Request $request) {

        return $this->render('AdminBundle::dashboardAdmin.html.twig');
    }

    public function gestionCommandesAction(Request $request) {

        return $this->render('AdminBundle::gestionCommandes.html.twig');
    }

    public function gestionEvenementsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $eventsCount = $em->getRepository("AdminBundle:Evenement")->countAllEvents();
        $countEventsByMusique = $em->getRepository("AdminBundle:Evenement")->countEventsByMusique();
        var_dump((float)$countEventsByMusique);
        $countEventsByCinema = $em->getRepository("AdminBundle:Evenement")->countEventsByCinema();
        $countEventsByTheatre =$em->getRepository("AdminBundle:Evenement")->countEventsByTheatre();
        $countEventsByFestivals = $em->getRepository("AdminBundle:Evenement")->countEventsByFestivals();
        $countEventsBySport=$em->getRepository("AdminBundle:Evenement")->countEventsBySport();
        $countEventsByConcert =$em->getRepository("AdminBundle:Evenement")->countEventsByConcert();


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
            array('Musique', (float)$countEventsByMusique),
            array('Cinéma', (float)$countEventsByCinema),
            array('Théatre', (float)$countEventsByTheatre),
            array('Festivals', (float)$countEventsByFestivals),
            array('Sport', (float)$countEventsBySport),
            array('Concert', (float)$countEventsByConcert),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('AdminBundle::gestionEvent.html.twig', array('chart' => $ob));
    }






    public function gestionUtlisateursAction(Request $request) {

        return $this->render('AdminBundle::gestionUtlisateur.html.twig');
    }

    public function gestionCommantaireAction(Request $request) {

        return $this->render('AdminBundle::gestionCommantaire.html.twig');
    }

    public function gestionTemoignagesAction(Request $request) {

        return $this->render('AdminBundle::gestionTemoignages.html.twig');
    }

    public function gestionNewslettersAction(Request $request) {

        return $this->render('AdminBundle::gestionNewsletters.html.twig');
    }
}

