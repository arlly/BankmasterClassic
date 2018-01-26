<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/25
 * Time: 19:08
 */

namespace AppBundle\Controller;


use AppBundle\Criteria\IdCriteriaBuilder;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends FOSRestController implements ClassResourceInterface
{
    // get collection of posts
    public function cgetAction()
    {
        $articles = $this->get('bankmaster.article_repository')->findAll();
        return $articles;
    }

    public function getAction(int $id)
    {
        $article = $this->get('bankmaster.article.get_one')->run(new IdCriteriaBuilder($id, false));
        return $article;
    }

    public function postAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', ArticleType::class, new Article(), [
            'csrf_protection' => false
        ]);

        $form->handleRequest($request);

        if (! $form->isValid()) return $form;

        $article = $form->getData();
        $this->get('bankmaster.article.create')->run($article);
        return $article;
    }

    // get collection of comments under the post
    public function getCommentsAction(int $id)
    {

    }

    // create new comment under the post
    public function postCommentAction(int $id, Request $request)
    {

    }


}