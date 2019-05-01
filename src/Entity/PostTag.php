<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post_tag")
 */
class PostTag
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Post")
     */
    private $post;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    private $tag;

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag): self
    {
        $this->tag = $tag;

        return $this;
    }
}