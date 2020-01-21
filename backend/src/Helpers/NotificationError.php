<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:56 AM
 */

namespace App\Helpers;

/**
 * Class NotificationError
 * @package App\Helpers
 */
class NotificationError
{
    private $statusCode = 400;
    private $errors = [];
    private $isError = false;

    public function reset(): void
    {
        $this->statusCode = 400;
        $this->errors = [];
        $this->isError = false;
    }

    public function setStatusCode(int $status): NotificationError
    {
        $this->statusCode = $status;
        return $this;
    }

    public function pushError(string $key, $value = []): NotificationError
    {
        $this->errors[$key] = $value;
        $this->isError = true;
        return $this;
    }

    public function getSatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getIsError(): bool
    {
        return $this->isError;
    }

}