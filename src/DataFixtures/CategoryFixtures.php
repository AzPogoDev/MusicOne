<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixtures
{
    protected function getType(): string
    {
        return Category::class;
    }

    protected function getFile(): string
    {
        return 'category';
    }

    protected function getReferenceKey($entity): string
    {
        return $entity->getName();
    }
}
