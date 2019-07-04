<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'articul' => $this->articul,
            'name' => $this->name,
            'price' => $this->price,
            'attributes' => ProductAttributeResource::collection($this->whenLoaded('attributes')),
            'related' => ProductResource::collection($this->whenLoaded('related')),
            'relatedTo' => new ProductResource($this->whenLoaded('relatedTo')),
        ];
    }
}
