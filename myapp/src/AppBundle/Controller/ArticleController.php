<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/25
 * Time: 19:08
 */

namespace AppBundle\Controller;


use AppBundle\Criteria\IdCriteriaBuilder;
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