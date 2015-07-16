<?php
/**
 * Created by PhpStorm.
 * User: abdou
 * Date: 7/16/15
 * Time: 3:08 AM
 */

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations AS Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * REST controller for Comment
 * @Prefix("/api/comment")
 * @NamePrefix("app_api_comment")
 */
class CommentApIController extends  FOSRestController
{

    /**
     * request to get all comment of article
     * @Rest\View
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getAction(Request $request)
    {
        $APIHelper       = $this->get('api_helper');
        $commentService  = $this->get('comment_service');
        $ArticleId       = (int)$request->get('id');
        $articleComments = $commentService->getCommentByArticleId($ArticleId);
        $view            = $APIHelper->getSuccessView(['comments'=>$articleComments]);
        return $this->handleView($view);
    }

    /**
     * request to add comment to article
     * @Rest\View
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function postAddAction(Request $request)
    {
        $APIHelper       = $this->get('api_helper');
        $commentService  = $this->get('comment_service');
        $articleId       = $request->get('id');
        $comment         = $request->get('comment');
        $comments        = $commentService->addCommentAndGetComment($articleId,$comment);
        $view            = $APIHelper->getSuccessView(['comments'=>$comments]);
        return $this->handleView($view);
    }

}