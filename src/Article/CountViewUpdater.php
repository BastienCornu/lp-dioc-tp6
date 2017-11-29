<?php

namespace App\Article;

use App\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CountViewUpdater
{

    public $token;
    /**
     * CountViewUpdater constructor.
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->token = $tokenStorage;
    }

    public function update(Article $article): void
    {
        // Incremente le compteur de vue, sauf si l'utilisareur courant est également l'auteur de l'article.
        if(!$article->getAuthor() === $this->token->getToken()->getUser()){
            $article->setCountView($article->getCountView() + 1);
        }
    }
}
