<?php


namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class UserFixtures extends AbstractFixtures
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, ParameterBagInterface $parameterBag)
    {
        parent::__construct($parameterBag);
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function getType(): string
    {
        return User::class;
    }

    protected function getFile(): string
    {
        return 'user';
    }

    protected function hookStatus($entity, $data)
    {
        $constant = sprintf('%s::%s', User::class, $data);
        $status = constant($constant);
        $entity->setStatus($status);
    }

    protected function hookPassword($entity, $data)
    {

        $entity->setPassword($this->passwordEncoder->hashPassword($entity, $data));
    }

    protected function getReferenceKey($entity): string
    {
        return $entity->getEmail();
    }
}
