<?php

declare(strict_types=1);

namespace Zeelo\Shared\Infrastructure\Symfony\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class AbstractRepository
{
    protected EntityManagerInterface $entityManager;
    protected ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->className());
    }

    public function persist($entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    abstract public function className(): string;
}
