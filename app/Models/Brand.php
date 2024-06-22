<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */

    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name'
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
