<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Detail extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    protected $table = 'product_detail';
    protected $primaryKey = 'product_detail_id';
    protected $fillable = [
        'product_id',
        'price',
        'sale_price',
        'color',
        'material',
        'size',
        'quantity',
        'image',
        'created_at',
        'updated_at'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order_detail()
    {
        return $this->hasMany(Order_Detail::class, 'product_detail_id');
    }
}
