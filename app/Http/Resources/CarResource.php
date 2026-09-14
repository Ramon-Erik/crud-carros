<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'model' => $this->model,
            'manufactureYear' => $this->manufacture_year,
            'color' => $this->color,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }
}
