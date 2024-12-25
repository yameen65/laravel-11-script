<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tittle' ,
    'content',
    'user_id',
    'image'
];

public function comments()
{
    return $this->hasMany(Comment::class , 'post_id');
}

public function rating()
{
    return $this->hasMany(rating::class, 'post_id');
}





}
