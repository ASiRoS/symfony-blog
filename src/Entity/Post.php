<?php

namespace App\Entity;

use App\Listener\Doctrine\Timestamp\TimestampInterface;
use App\Traits\Doctrine\Id;
use App\Traits\Doctrine\Published;
use App\Traits\Doctrine\Timestamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post implements TimestampInterface
{
    use Id, Published, Timestamp;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts", cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }

    public function addTag(Tag $tag): void
    {
        if($this->tags->contains($tag)) {
            return;
        }

        $this->tags->add($tag);
    }

    public function removeTag(Tag $tag): void
    {
        if($this->tags->contains($tag)) {
            $this->tags->remove($tag);
        }
    }
}