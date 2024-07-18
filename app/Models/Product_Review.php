<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Review extends Model
{
    protected $table = 'product_reviews';
    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'image',
        'created_at',
        'updated_at'
    ];
}
