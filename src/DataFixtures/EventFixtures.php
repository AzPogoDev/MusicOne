<?php


namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class EventFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    protected function getType(): string
    {
        return Event::class;
    }

    protected function getFile(): string
    {
        return 'event';
    }

    protected function getReferenceKey($entity): string
    {
        return $entity->getName();
    }

    protected function hookCategory($entity, $data)
    {
        $key = sprintf('%s_%s', 'category', $data);
        $category = $this->getReference($key);
        $entity->setCategory($category);
    }

    protected function hookOwner($entity, $data)
    {
        $key = sprintf('%s_%s', 'user', $data);
        $owner = $this->getReference($key);
        $entity->setOwner($owner);
    }

    protected function hookPlace($entity, $data)
    {
        $key = sprintf('%s_%s', 'place', $data);
        $place = $this->getReference($key);
        $entity->setPlace($place);
    }

    /**
     * @throws \Exception
     */
    protected function hookStartAt($entity, $data)
    {
        $startDate = new DateTime($data);
        $startImmutable = DateTimeImmutable::createFromMutable($startDate);
        $entity->setStartAt(
            $startImmutable
        );
    }

    /**
     * @throws \Exception
     */
    protected function hookEndAt($entity, $data)
    {
        $endDate = new DateTime($data);
        $endImmutable = DateTimeImmutable::createFromMutable($endDate);
        $entity->setEndAt(
            $endImmutable
        );
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            PlaceFixtures::class,
            UserFixtures::class
        ];
    }
}
