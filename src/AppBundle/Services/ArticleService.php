<?php

namespace AppBundle\Services;

use AppBundle\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;

class ArticleService
{

    /** @var ArticleRepository $articleRepo */
    protected $articleRepo;
    /** @var EntityManager $entityManager */
    protected $entityManager;

    /**
     * @param ArticleRepository $articleRepo
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, ArticleRepository $articleRepo )
    {
        $this->articleRepo    = $articleRepo;
        $this->entityManager  = $em;
    }

    /**
     * get all posts created by authors
     * @return array $posts
     */
    public function getAllPosts()
    {
        $posts = $this->articleRepo->findAll();
        return $posts;
    }

}


