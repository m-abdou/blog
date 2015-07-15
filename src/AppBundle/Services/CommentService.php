<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Repository\CommentRepository;


class CommentService
{

    /** @var CommentRepository $commentRepo */
    protected $commentyRepo;
    /** @var EntityManager $entityManager */
    protected $entityManager;

    /**
     * @param CommentRepository $commentRepo
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em ,CommentRepository $commentRepo)
    {
        $this->categoryRepo   = $commentRepo;
        $this->entityManager  = $em;
    }

}