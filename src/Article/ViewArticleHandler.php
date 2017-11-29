<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ViewArticleHandler
{
    public $updateArticle;
    public $statLog;

    /**
     * ViewArticleHandler constructor.
     * @param $updateArticle
     */
    public function __construct(UpdateArticleHandler $updateArticle, ArticleStatsLogger $statLog)
    {
        $this->updateArticle = $updateArticle;
        $this->statLog = $statLog;
    }


    public function handle(Article $article)
    {
        // Appel le service de mise à jour de vue d'un article.
        $this->updateArticle->handle($article);
        // Log également un article stat avec pour action view.
        $this->statLog->log($article,"view");
    }
}
