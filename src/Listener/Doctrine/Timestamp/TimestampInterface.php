<?php

namespace App\Listener\Doctrine\Timestamp;

use DateTime;

interface TimestampInterface
{
    public function getCreated(): ?DateTime;

    public function setCreated(DateTime $created);

    public function getUpdated(): ?DateTime;

    public function setUpdated(DateTime $updated);
}