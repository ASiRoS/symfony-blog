<?php

namespace App\Listener\Doctrine\Timestamp;

use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TimestampListener implements EventSubscriber
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        if($entity = $this->getEntity($args)) {
            $entity
                ->setCreated(new DateTime())
                ->setUpdated(new DateTime())
            ;
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if($entity = $this->getEntity($args)) {
            $entity->setUpdated(new DateTime());
        }
    }

    public function getSubscribedEvents(): array
    {
        return ['prePersist', 'preUpdate'];
    }

    private function getEntity(LifecycleEventArgs $args)
    {
        if($args->getEntity() instanceof TimestampInterface) {
            return $args->getEntity();
        }
    }
}