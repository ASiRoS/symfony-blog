<?php

namespace App\Entity;

use App\Traits\Doctrine\Id;
use App\Traits\Doctrine\Published;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @ORM\Table(name="tag")
 * @UniqueEntity("title")
 */
class Tag
{
    use Id, Published;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->title;
    }
}