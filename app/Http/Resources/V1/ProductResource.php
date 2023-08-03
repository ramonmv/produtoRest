<?php

namespace App\Http\Resources\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CategoryResource;
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
            'name' => $this->name,
            'description' => $this->description,
            'value' => $this->value,
            'category' => new CategoryResource(
                Category::findOrFail($this->categories_id)
            ),
        ];
    }
    
    public function with($request)
    {
        return ['mensagem' => 'sucesso'];
    }
}
