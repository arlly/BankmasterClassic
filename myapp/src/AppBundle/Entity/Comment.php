<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment implements EntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     */
    private $post;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set post.
     *
     * @param \AppBundle\Entity\Article $post
     *
     * @return Comment
     */
    public function setPost(\AppBundle\Entity\Article $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post.
     *
     * @return \AppBundle\Entity\Article
     */
    public function getPost()
    {
        return $this->post;
    }
}
