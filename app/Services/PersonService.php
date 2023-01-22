<?php

namespace App\Services;

use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class PersonService
{
    public function get()
    {
        return Auth::user()->person;
    }

    public function getPerson($id)
    {
        return Person::find($id);
    }

    public function followPerson($id)
    {
        if (Auth::user()->person->followings()->find($id)) {
            return;
        }

        Auth::user()->person->followings()->attach($id);
    }

    public function unfollowPerson($id)
    {
        if (! Auth::user()->person->followings()->find($id)) {
            return;
        }

        Auth::user()->person->followings()->detach($id);
    }

    public function update($fields)
    {
        Auth::user()->person->update($fields);
    }

    public function generateToken()
    {
        Auth::user()->tokens()->delete();
        $token = Auth::user()->createToken('Bearer');

        return $token->plainTextToken;
    }
}
