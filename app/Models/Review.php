<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
class Review extends Model
{
    use HasFactory;
    protected $guraded=[];

    protected $fillable=[
        'customer','star','review','product_id'
    ];

    public function product()
    {
        return $this->belongTo(Product::class);
    }
}
