<?php

namespace App\Entity;

use App\Listener\Doctrine\Timestamp\TimestampInterface;
use App\Traits\Doctrine\Id;
use App\Traits\Doctrine\Published;
use App\Traits\Doctrine\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment implements TimestampInterface
{
    use Id, Published, Timestamp;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Post")
     */
    private $post;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="10")
     */
    private $text;

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }
}