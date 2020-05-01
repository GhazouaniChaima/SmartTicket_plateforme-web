<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use AppBundle\Entity\Categorie;

class LoadCategorieData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $libelleCategories = array('Cinéma', 'Théatre', 'Musique', 'Fistivals', 'Sport', 'Cencert');
        foreach ($libelleCategories as $i => $libelleCategorie) {
            $liste_categories[$i] = new Categorie();
            $liste_categories[$i]->setLibelleCategorie($libelleCategorie);
            $manager->persist($liste_categories[$i]);
        }

        $manager->flush();
    }
}