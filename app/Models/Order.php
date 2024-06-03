<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'status',
        'consignee',
        'phone_number',
        'address',
        'payment_method',
        'shipping_unit',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
