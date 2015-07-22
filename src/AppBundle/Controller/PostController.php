<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Controller\BaseController;

class PostController extends BaseController
{
    /**
     * create post by author
     * @Route("/post/create")
     * @Template("")
     */
    public function createAction(Request $request)
    {
        if(!$this->isUser()){
            return $this->redirect($this->generateUrl('app_blog_home'));
        }
        $em       = $this->getEntityManager();
        $article  = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);
        if($form->isValid()){
            $article = $form->getData();
            $article->setCreateAt();
            $article->setUpdateAt();
            $article->setAuthor($this->getUser());
            $em->persist($article);
            $em->flush();
            $url = $this->generateUrl('app_post_edit',['id'=>$article->getId()]);
            return $this->redirect($url);
        }

        return array(
            'form'   => $form->createView(),
            'entity' => $article
        );
    }

    /**
     * edit post by author
     * @Route("/post/edit/{id}")
     * @Template("")
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function editAction(Request $request,Article $article)
    {
        if(!($this->isUser() && $this->isArticleAuthor($article->getAuthor()->getId())))
        {
            return $this->redirect($this->generateUrl('app_post_list'));
        }
        $em   = $this->getEntityManager();
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);
        if($form->isValid()){
            $article = $form->getData();
            $article->setUpdateAt();
            $em->persist($article);
            $em->flush();
            $url = $this->generateUrl('app_post_edit',['id'=>$article->getId()]);
            return $this->redirect($url);
        }

        return array(
            'form'   => $form->createView(),
            'entity' => $article
        );
    }

    /**
     * list all posts created by author
     * @Route("/post/list")
     * @Template("AppBundle:Post:list.html.twig")
     */
    public function listAction()
    {
        if(!$this->isUser()){
            return $this->redirect($this->generateUrl('app_blog_home'));
        }
        $userId      = $this->getUser()->getId();
        $postService = $this->get('article_service');
        $posts       = $postService->getPostsByAuthor($userId);
        return array(
            'posts' => $posts
        );
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    /**
     * check if user is the author of article or not
     * @param $authorId
     * @return bool
     */
    public function isArticleAuthor($authorId)
    {
        $userId = $this->getUserId();
        if ($userId == $authorId) {
            return true;
        } else {
            return false;
        }
    }

}