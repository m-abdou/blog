<?php

namespace AppBundle\Services;

use AppBundle\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Article;

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
     * get all posts created by authors as type Publish
     * @return array $posts
     */
    public function getAllPosts()
    {
        $posts = $this->articleRepo->findBy(['visibility' => Article::Published]);
        return $posts;
    }

    /**
     * get all posts created by authors as type Publish
     * @return array $posts
     */
    public function getPostsByCategory($category)
    {
        $posts = $this->articleRepo->findBy(['category' => $category,'visibility' => Article::Published]);
        return $posts;
    }

}


