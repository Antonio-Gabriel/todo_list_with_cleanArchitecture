<?php

declare(strict_types=1);

namespace Todo\Common;

use Ramsey\Uuid\UuidFactory;

/**
 * Entity.
 *
 * The base for all entities of app.
 *
 * @author António Gabriel <antoniocamposgabriel@gmail.com>
 */

abstract class Entity
{
    public function __construct(
        public $props,
        protected ?string $id = null
    ) {
        $generateUuid = new UuidFactory();
        $this->id = strval($generateUuid?->uuid4());
    }

    public function getId(): string
    {
        return $this->id;
    }
}
