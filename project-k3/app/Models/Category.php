<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory, softDeletes;

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    protected $fillable = [
        'name',
        'status',
        'desc',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
