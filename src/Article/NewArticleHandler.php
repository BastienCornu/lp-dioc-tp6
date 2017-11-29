<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Validator\Constraints\DateTime;

class NewArticleHandler
{

    public $slugGen;
    public $statLog;
    public $tokenStorage;
    /**
     * NewArticleHandler constructor.
     */
    public function __construct(SlugGenerator $slugGen, ArticleStatsLogger $statLog, TokenStorage $tokenStorage)
    {
        $this->slugGen = $slugGen;
        $this->statLog = $statLog;
        $this->tokenStorage = $tokenStorage;
    }

    public function handle(Article $article): void
    {
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        $article->setSlug($this->slugGen->generate($article->getTitle()));
        $article->setAuthor($this->tokenStorage->getToken()->getUser());
        $article->setCountView(0);
        $article->setCreatedAt(new DateTime());
        $article->setUpdatedAt(new DateTime());
        // Log également un article stat avec pour action create.

        $this->statLog->log($article,"create");
    }
}
