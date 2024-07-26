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
        'product_name',
        'description',
        'created_at',
        'updated_at'
    ];
    public function product_detail()
    {
        return $this->hasMany(Product_Detail::class, 'product_id');
    }
    public function product_review()
    {
        return $this->hasMany(Product_Review::class, 'product_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
