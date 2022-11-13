<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PersonService
{
    public function get()
    {
        return Auth::user()->person;
    }

    public function update($fields)
    {
        Auth::user()->person->update($fields);
    }
}
