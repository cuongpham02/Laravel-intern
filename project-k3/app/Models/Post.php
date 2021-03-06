<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory, softDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'status',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
