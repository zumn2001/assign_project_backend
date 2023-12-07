<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_id' => $this->image,
            'status' => $this->status,
            'updated'=> $this->updated_at->format('d-m-y'),
            'created' => $this->created_at->format('d-m-y'),
        ];
    }
}
