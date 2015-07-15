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
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CategoryController extends Controller
{

    /**
     * create New Category
     * @Route("/category/create")
     * @Template("")
     */
    public function createAction(Request $request)
    {
        $em             = $this->getEntityManager();
        $categoryEntity = new Category();
        $form           = $this->createForm(new CategoryType(), $categoryEntity);
        $form->handleRequest($request);
        if($form->isValid()){
            $categoryEntity = $form->getData();
            $em->persist($categoryEntity);
            $em->flush();
            $url = $this->generateUrl('app_category_edit',['id'=>$categoryEntity->getId()]);
            return $this->redirect($url);
        }

        return array(
            'form'   => $form->createView(),
            'entity' => $categoryEntity
        );
    }

    /**
     * edit category by author
     * @Route("/category/edit/{id}")
     * @Template("")
     * @ParamConverter("category", class="AppBundle:Category")
     */
    public function editAction(Request $request,Category $category)
    {
        $em   = $this->getEntityManager();
        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);
        if($form->isValid()){
            $categoryEntity = $form->getData();
            $em->persist($categoryEntity);
            $em->flush();
            $url = $this->generateUrl('app_category_edit',['id'=>$categoryEntity->getId()]);
            return $this->redirect($url);
        }

        return array(
            'form'   => $form->createView(),
            'entity' => $category
        );
    }


    /**
     * edit post by author
     * @Route("/category/list")
     * @Template("")
     */
    public function listAction()
    {
        $categoryService = $this->get('category_service');
        $categories      = $categoryService->getCategories();
        return array(
            'categories' => $categories
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