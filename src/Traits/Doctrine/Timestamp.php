<?php

namespace App\Traits\Doctrine;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait Timestamp
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(DateTimeImmutable $created)
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(DateTimeImmutable $updated)
    {
        $this->updated = $updated;

        return $this;
    }
}