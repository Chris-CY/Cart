<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status','order_date'];

    public static $status = [
        'C' => 'Cancelled',
        'D' => 'Completed',
        'P' => 'Pending',
        'S' => 'Submitted',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity');
    }
}
