<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ArticleStatsLogger
{
    public $doctrine;
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function log(Article $article, string $action): void
    {
        $em = $this->doctrine->getManager();

        // Créer un article stat et le persist.
        $articleStat = new ArticleStat($action,new \DateTime(),null,$article,null);
        $em->persist($articleStat);
    }
}
