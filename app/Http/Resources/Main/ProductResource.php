<?php

namespace App\Http\Resources\Main;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'sku' => $this->sku,
            'slug' => $this->slug,
            'image' => $this->image,
            'name' => $this->name,
            'category' => $this->category->name,
            'min_purchase' => $this->min_purchase,
            'selling_price' => $this->selling_price,
            'purchase_price' => $this->purchase_price,
            'unit' => $this->unit,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'status' => $this->status
        ];
    }
}
