<?php

namespace Model;

class QueryResult
{
    private ?string $error;
    private ?array $result;

    /**
     * QueryResult constructor.
     * @param array|null $result
     * @param string|null $error
     * @param int $statusCode
     */
    public function __construct(
        ?array $result,
        ?string $error,
        $statusCode = 200
    ) {
        $this->error = $error;
        $this->result = $result;
        header($statusCode);
    }

    /**
     * @return array|mixed|null
     */
    public function getResult()
    {
        if (is_null($this->result)) {
            return null;
        }
        if (count($this->result) === 1) {
            return $this->result[array_key_first($this->result)];
        }

        return $this->result;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        if (is_null($this->error)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error != null ? $this->error : '';
    }
}
