<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'discount'=>$this->discount,
            'total_price'=>round((1-($this->discount/100)) * $this->price,2),
            'rating'=>$this->review->count() >0 ? round($this->review->sum('star')/$this->review->count(),2) : 'No Rating Yet',
            'href'=>[
                'link'=>route('products.show',$this->id)
            ]
        ];
    }
}
