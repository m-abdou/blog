<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends Controller
{
    /**
     * create post by author
     * @Route("/post/create")
     * @Template("")
     */
    public function createAction(Request $request)
    {
        $em       = $this->getEntityManager();
        $article  = new Article();
        $form = $this->createForm(new ArticleType(), $article);
        $form->handleRequest($request);
        if($form->isValid()){
            $article = $form->getData();
            $article->setCreateAt();
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
     * edit post by author
     * @Route("/post/edit/{id}")
     * @Template("")
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function editAction(Request $request,Article $article)
    {
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
     * edit post by author
     * @Route("/post/list")
     * @Template("AppBundle:Post:list.html.twig")
     */
    public function listAction()
    {
        $postService = $this->get('article_service');
        $posts       = $postService->getAllPosts();
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
}