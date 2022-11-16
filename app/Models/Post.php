<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function likedPeople()
    {
        return $this->belongsToMany(Person::class, 'likes', 'post_id', 'person_id');
    }
}
