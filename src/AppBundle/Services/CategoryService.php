<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Repository\CategoryRepository;

class CategoryService
{

    /** @var CartRepository $categoryRepo */
    protected $categoryRepo;
    /** @var EntityManager $entityManager */
    protected $entityManager;

    /**
     * @param CategoryRepository $categoryRepo
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em,CategoryRepository $categoryRepo )
    {
        $this->categoryRepo   = $categoryRepo;
        $this->entityManager  = $em;
    }


    /**
     * gat all categories created by admin
     * @return array
     */
    public function getCategories()
    {
        $categories = $this->categoryRepo->findAll();
        return $categories;
    }

}