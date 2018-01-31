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
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function putAction(Request $request, int $id)
    {
        $article = $this->get('bankmaster.article.get_one')->run(new IdCriteriaBuilder($id, false));

        if (! $article) return new View(null, Response::HTTP_NOT_FOUND);

        $form = $this->get('form.factory')->createNamed('', ArticleType::class, $article, [
            'csrf_protection' => false
        ]);
        $form->submit($request->request->all());

        if (! $form->isValid()) return $form;

        $this->get('bankmaster.article.update')->run($article);
        return new View(json_encode($request->request->all()), Response::HTTP_OK);
    }

    public function deleteAction(int $id)
    {
        $article = $this->get('bankmaster.article.get_one')->run(new IdCriteriaBuilder($id, false));

        if (! $article) return new View(null, Response::HTTP_NOT_FOUND);

        $this->get('bankmaster.article.remove')->run($article);
        return new View(null, Response::HTTP_NO_CONTENT);
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