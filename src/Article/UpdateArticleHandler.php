<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Validator\Constraints\Date;

class UpdateArticleHandler
{
    public $slugGen;
    public $statLog;
    /**
     * NewArticleHandler constructor.
     */
    public function __construct(SlugGenerator $slugGen, ArticleStatsLogger $statLog)
    {
        $this->slugGen = $slugGen;
        $this->statLog = $statLog;
    }
    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        $article->setSlug($article->getTitle());
        $article->setUpdatedAt(date("now"));
        // Log également un article stat avec pour action update.
        $this->statLog->log($article,"update");
    }
}
