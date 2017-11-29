<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction($slug)
    {

    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request, NewArticleHandler $articleHandler)
    {
        // Seul les auteurs doivent avoir access.
        $em = $this->getDoctrine()->getManager();
        $article = new Article();

        $form = $this->createForm(ArticleType::class,$article);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $articleHandler->handle($article);
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('homepage'));
        }
        return $this->render("Article/new.html.twig",['form'=>$form->createView(), ]);

    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction()
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
    }
}
