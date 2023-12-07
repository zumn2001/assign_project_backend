<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'item_name' => $this->item_name,
            'owner_name' => $this->owner_name,
            'category_id' => $this->category,
            'phone' => $this->phone,
            'price' => $this->price,
            'address' => $this->address,
            'location' => $this->location,
            'description' => $this->description,
            'item_condition' => $this->item_condition,
            'item_type' => $this->item_type,
            'status' => $this->status,
            'image_id' => $this->image,
        ];
    }
}
