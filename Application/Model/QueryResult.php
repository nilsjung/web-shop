<?php

namespace Model;

class QueryResult
{
    private ?string $error;
    private ?array $result;

    public function __construct(
        ?array $result,
        ?string $error,
        $statusCode = 200
    ) {
        $this->error = $error;
        $this->result = $result;
        header($statusCode);
    }

    public function getResult()
    {
        if (count($this->result) === 1) {
            return $this->result[array_key_first($this->result)];
        }

        return $this->result;
    }

    public function hasError(): bool
    {
        if (is_null($this->error)) {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->error != null ? $this->error : '';
    }
}
