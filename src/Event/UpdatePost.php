<?php

namespace App\Event;

use App\Entity\Booking;
use App\Entity\Place;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Event;

class UpdatePost implements EventSubscriberInterface

{

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::postUpdate
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Event || $entity instanceof Booking || $entity instanceof User || $entity instanceof Place) {
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Event || $entity instanceof Booking || $entity instanceof User || $entity instanceof Place) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}
