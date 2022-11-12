<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        return $this->belongsToMany(Person::class, 'person_person', 'following_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(Person::class, 'person_person', 'follower_id', 'following_id');
    }
}
