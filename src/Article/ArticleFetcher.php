<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;

class ArticleFetcher
{
    public function __construct(EntityManagerInterface $em, $limit)
    {
        $this->em = $em;
        $this->limit = $limit;
    }

    public function fetch() : array
    {
        // Retourne les 10 derniers articles.
        $articles = $this->em->getRepository(\App\Entity\Article::class)->findBy(array(),array('createdAt'=>'DESC'),$this->limit);
        // La limit (ici 10) doit provenir d'une variable d'env.

        return $articles;
    }
}
