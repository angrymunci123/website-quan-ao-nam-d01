<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */

    protected $table = 'news';
    protected $primaryKey = 'news_id';
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
