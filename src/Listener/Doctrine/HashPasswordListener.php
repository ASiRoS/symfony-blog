<?php

namespace App\Listener\Doctrine;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordListener implements EventSubscriber
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->encodePassword($args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->encodePassword($args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    private function encodePassword(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User || !$entity->getPlainPassword()) {
            return;
        }

        $encoded = $this->encoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        );

        $entity->setPassword($encoded);
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }
}
