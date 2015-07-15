<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
new \Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotNull(message="content can't be left empty")
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Article", inversedBy="comments");
     * @ORM\JoinColumn(name="article_id",referencedColumnName="id");
     */
    private $article;



}