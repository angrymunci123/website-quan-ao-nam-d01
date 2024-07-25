<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */

    protected $table = 'order_detail';
    // protected $primaryKey = 'order_detail_id';
    protected $fillable = [
        'order_id',
        'product_detail_id',
        'price',
        'quantity',
        'created_at',
        'updated_at'
    ];
    public function product_detail()
    {
        return $this->belongsTo(Product_Detail::class, 'product_detail_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
