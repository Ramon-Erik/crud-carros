<?php

namespace App\Support\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use function is_null;

class ApiResponse
{
    protected string $message = 'Sucesso!';
    protected mixed $data = null;
    protected mixed $pagination = null;
    protected mixed $errors = null;
    protected int $code = 200;

    public static function build(): static
    {
        return new ApiResponse();
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function setData(mixed $data): static
    {
        if ($data instanceof LengthAwarePaginator) {
            $this->setPagination($data);
            $this->data = $data->items();
            return $this;
        }

        if (
            $data instanceof ResourceCollection &&
            $data->resource instanceof LengthAwarePaginator
        ) {
            $this->setPagination($data->resource);
            $this->data = $data;
            return $this;
        }

        $this->data = $data;
        return $this;
    }

    public function setPagination(LengthAwarePaginator $pagination): static
    {
        $this->pagination = [
            'currentPage' => $pagination->currentPage(),
            'lastPage' => $pagination->lastPage(),
            'perPage' => $pagination->perPage(),
            'total' => $pagination->total(),
        ];
        return $this;
    }

    public function setErrors(mixed $errors): static
    {
        $this->errors = $errors;
        return $this;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;
        return $this;
    }

    public function toArray()
    {
        $response = [
            'statusCode' => $this->code,
            'message' => $this->message
        ];

        if (!is_null($this->data)) {
            $response['data'] = $this->data;

        }
        if (!is_null($this->pagination))
            $response['pagination'] = $this->pagination;

        if (!is_null($this->errors))
            $response['errors'] = $this->errors;

        return $response;
    }

    public function response(): JsonResponse
    {
        return response()->json($this->toArray(), $this->code);
    }
}
