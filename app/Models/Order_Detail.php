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
        'quantity'
    ];
}
