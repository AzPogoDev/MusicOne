<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractFixtures extends Fixture
{

    private $config;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->config = $parameterBag->get('fixture');
    }

    public function load(ObjectManager $manager): void
    {
        $type = $this->getType();
        $raw = Yaml::parseFile($this->config['path'] . '/' . $this->getFile() . '.yaml');

        foreach ($raw['data'] as $data) {
            $entity = new $type;
            foreach ($data as $key => $value) {
                $hook = sprintf('hook%s', ucfirst($key));
                if (method_exists($this, $hook)) {
                    $this->$hook($entity, $value);
                } else {
                    $setter = 'set' . ucfirst($key);
                    $entity->$setter($value);
                }
            }
            $key = sprintf('%s_%s', $this->getFile(), $this->getReferenceKey($entity));
            $this->addReference($key, $entity);
            $manager->persist($entity);
        }
        $manager->flush();
    }

    protected abstract function getType(): string;

    protected abstract function getFile(): string;

    protected abstract function getReferenceKey($entity): string;

}