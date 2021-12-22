<?php

declare(strict_types=1);

namespace Zeelo\ItemContext\Infrastructure\Item\Persistence\Repository;

use Zeelo\ItemContext\Domain\Item\Item;
use Zeelo\ItemContext\Domain\Item\ItemId;
use Zeelo\ItemContext\Domain\Item\Repository\ItemRepositoryInterface;
use Zeelo\Shared\Infrastructure\Symfony\Repository\AbstractRepository;

final class ItemRepository extends AbstractRepository implements ItemRepositoryInterface
{
    public function className(): string
    {
        return Item::class;
    }

    public function findById(ItemId $id): ?Item
    {
        return $this->repository->find($id);
    }

    public function findBy(array $params, array $orderBy = null, $limit = null, $offset = null): ?array
    {
        return $this->repository->findBy($params, $orderBy, $limit, $offset);
    }

    public function save(Item $item): void
    {
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }
}
