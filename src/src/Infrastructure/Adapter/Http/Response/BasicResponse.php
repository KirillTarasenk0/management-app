<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter\Http\Response;

use JsonSerializable;

readonly class BasicResponse implements JsonSerializable
{
    public function __construct(
        protected bool   $status,
        protected string $message,
        protected mixed  $data = [],
    ) {
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'status'  => $this->status,
            'message' => $this->message,
            'data'    => $this->data,
        ];
    }
}
