<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends Controller
{
    /**
     * create post by author
     * @Route("/post/create")
     * @Template("AppBundle:Post:Create.html.twig")
     */
    public function createAction(Request $request)
    {
        $postEntity = new Post();
        $form = $this->createForm(new PostType(), $postEntity);
        $form->handleRequest($request);
        if($form->isValid()){

        }

        return array(
            'form'   => $form->createView(),
            'entity' => $postEntity
        );
    }

    /**
     * edit post by author
     * @Route("/post/edit/{id}")
     * @Template("AppBundle:Post:edit.html.twig")
     * @ParamConverter("post", class="AppBundle:Post")
     */
    public function editAction(Request $request,Post $post)
    {
        $em   = $this->getEntityManager();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if($form->isValid()){

        }

        return array(
            'form'   => $form->createView(),
            'entity' => $post
        );
    }

    /**
     * edit post by author
     * @Route("/posts")
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

}