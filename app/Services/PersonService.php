<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PersonService
{
    public function get()
    {
        return Auth::user()->person;
    }

    public function update($fiels)
    {
        Auth::user()->person->update($fiels);
    }
}
