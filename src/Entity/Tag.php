<?php

namespace App\Entity;

use App\Traits\Doctrine\Id;
use App\Traits\Doctrine\Published;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    use Id, Published;

    /**
     * @ORM\Column(type="string")
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
}