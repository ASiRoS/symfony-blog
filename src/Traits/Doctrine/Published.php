<?php

namespace App\Traits\Doctrine;

use Doctrine\ORM\Mapping as ORM;

trait Published
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $published = true;

    public function getPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }
}