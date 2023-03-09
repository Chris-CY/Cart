<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')
            ->withPivot('quantity');
    }

    public static function postProduct($details)
    {
        foreach ($details as $detail){
            $product = self::where('product_id', $detail['id'])->first();
            if (empty($product)) {
                $product = new Product();
            }

            if (!empty($detail['id'])) $product->product_id = $detail['id'];
            if (!empty($detail['name'])) $product->name = $detail['name'];
            if (!empty($detail['image_url'])) $product->image_url = $detail['image_url'];

            $product->save();
        }
    }
}
