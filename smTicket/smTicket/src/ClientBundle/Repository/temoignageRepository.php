<?php

namespace ClientBundle\Repository;

/**
 * temoignageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class temoignageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllorder()
    {
        $query = $this->getEntityManager()->createQuery("SELECT t FROM ClientBundle:temoignage  t  ORDER BY t.dateCreationCommentaire DESC ");
        return $query->getResult();
    }
}