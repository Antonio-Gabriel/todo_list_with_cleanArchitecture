<?php

declare(strict_types=1);

namespace Todo\Common;

/**
 * Result.
 *
 * Error handling and process state.
 *
 * @author António Gabriel <antoniocamposgabriel@gmail.com>
 */

abstract class Result
{
    public function __construct(
        private bool $isSuccess,
        private ?string $error = null,
        protected $value = null
    ) {
        if (
            $this->isSuccess && $this->error
        ) {
            throw new \Exception("InvalidOperation: A result cannot be successful and contain an error");
        }

        if (
            !$this->isSuccess && !$this->error
        ) {
            throw new \Exception("InvalidOperation: A failing result needs to contain an error message");
        }
    }

    public function getValue()
    {
        if (!$this->isSuccess) {
            throw new \Exception("Can't get the value of an error result. Use 'errorValue' instead.");
        }

        return $this->value;
    }

    public function errorValue()
    {
        return $this->error;
    }

    public static function Ok($value): self
    {
        // status ok
        return new Result(true, null, $value);
    }

    public static function Fail($error): self
    {
        // status bad
        return new Result(true, $error);
    }
}
