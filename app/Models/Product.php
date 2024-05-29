<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
