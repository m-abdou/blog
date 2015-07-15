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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CategoryController extends Controller
{

    /**
     * create post by author
     * @Route("/category/create")
     * @Template("")
     */
    public function createAction(Request $request)
    {
        $categoryEntity = new Category();
        $form = $this->createForm(new CategoryType(), $categoryEntity);
        $form->handleRequest($request);
        if($form->isValid()){

        }

        return array(
            'form'   => $form->createView(),
            'entity' => $categoryEntity
        );
    }
}