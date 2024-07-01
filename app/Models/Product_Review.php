<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Review extends Model
{
    protected $table = 'product_review';
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'image',
        'created_at',
        'updated_at'
    ];
}
