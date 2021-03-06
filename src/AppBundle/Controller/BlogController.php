<?php
/**
 * Created by PhpStorm.
 * User: abdou
 * Date: 7/14/15
 * Time: 5:27 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Controller\BaseController;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BlogController extends BaseController
{
    /**
     * @Route("/")
     * @Template("AppBundle:Blog:home.html.twig")
     */
    public function homeAction()
    {
        $postService     = $this->get('article_service');
        $categoryService = $this->get('category_service');
        $posts           = $postService->getAllPosts();
        $categories      = $categoryService->getCategories();
        return [
            'categories' => $categories,
            'posts'      => $posts
        ];
    }

    /**
     * get articles belongs to category
     * @Route("/list/category/{id}")
     * @Template("AppBundle:Blog:home.html.twig")
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function getArticlesByCategoryAction(Category $category)
    {
        $postService     = $this->get('article_service');
        $categoryService = $this->get('category_service');
        $posts           = $postService->getPostsByCategory($category);
        $categories      = $categoryService->getCategories();
        return [
            'categories' => $categories,
            'posts'      => $posts
        ];
    }

    /**
     * @Route("/adminPanel")
     * @Template("")
     */
    public function panelAction()
    {
        if ($this->isUser()) {
            return [];
        } else {
            return $this->redirect($this->generateUrl('app_blog_home'));
        }
    }

    /**
     * show article details
     * @Route("/article/{id}")
     * @Template("AppBundle:Blog:article.html.twig")
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function showArticleDetails(Article $article)
    {
        if(!$article->isPublished()){
            return $this->redirect($this->generateUrl('app_blog_home'));
        }
        return ['article' => $article];

    }

}