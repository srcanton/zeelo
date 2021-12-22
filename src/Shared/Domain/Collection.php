<?php

declare(strict_types=1);

namespace Zeelo\Shared\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\PersistentCollection;

abstract class Collection extends ArrayCollection implements DoctrineCollection
{
    /** @var PersistentCollection */
    private $persistent;

    public static function transform(?DoctrineCollection $items): DoctrineCollection
    {
        $class = get_called_class();
        if ($items instanceof PersistentCollection) {
            $elements = [];
            foreach ($items as $item) {
                array_push($elements, $item);
            }
            /** @var self $steps */
            $steps = new $class(...$elements);
            $steps->setPersistentCollection($items);
            return $steps;
        }
        if ($items) {
            return $items;
        }
        return new $class();
    }

    public function setPersistentCollection(PersistentCollection $collection): void
    {
        $this->persistent = $collection;
    }

    public function __toArray(): array
    {
        $elements = [];
        foreach ($this->getValues() as $item) {
            array_push($elements, $item->__toArray());
        }
        return $elements;
    }

    public function add($element): void
    {
        if ($this->persistent) {
            $this->persistent->add($element);
            return;
        }
        parent::add($element);
    }

    public function remove($element): void
    {
        if ($this->persistent) {
            $this->persistent->removeElement($element);
            return;
        }
        parent::removeElement($element);
    }
}
