<?php
/**
 * Created by PhpStorm.
 * User: abdou
 * Date: 7/14/15
 * Time: 5:27 AM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/home")
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

}