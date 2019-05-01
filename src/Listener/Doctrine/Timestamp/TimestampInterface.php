<?php

namespace App\Listener\Doctrine\Timestamp;

use DateTimeImmutable;

interface TimestampInterface
{
    public function getCreated(): DateTimeImmutable;

    public function setCreated(DateTimeImmutable $created);

    public function getUpdated(): DateTimeImmutable;

    public function setUpdated(DateTimeImmutable $updated);
}