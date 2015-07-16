<?php
namespace AppBundle\Services;

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\CommentRepository;
use AppBundle\Repository\ArticleRepository;

class CommentService
{

    /** @var CommentRepository $commentRepo */
    protected $commentRepo;
    /** @var EntityManager $entityManager */
    protected $entityManager;
    /** @var ArticleRepository $articleRepo */
    protected $articleRepo;

    /**
     * @param CommentRepository $commentRepo
     * @param EntityManager $em
     * @param ArticleRepository $articleRepo
     */
    public function __construct(EntityManager $em ,CommentRepository $commentRepo,ArticleRepository $articleRepo)
    {
        $this->commentRepo   = $commentRepo;
        $this->entityManager = $em;
        $this->articleRepo   = $articleRepo;
    }

    /**
     * @param $id
     * @return array of object $comments
     */
    public function getCommentByArticleId($id)
    {
          $comments = $this->commentRepo->findByArticle([$id]);
          return $comments;
    }

    /**
     * add comment belongs to article and return all comments referrer to this article
     * @param $articleId
     * @param $comment
     * @return mixed
     */
    public function addCommentAndGetComment($articleId,$comment)
    {
          $article = $this->articleRepo->find($articleId);
          $commentEntity = new Comment();
          $commentEntity->setContent($comment);
          $commentEntity->setArticle($article);
          $this->entityManager->persist($commentEntity);
          $this->entityManager->flush();
          return $this->getCommentByArticleId($articleId);
    }

}