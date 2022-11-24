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

    public function update($fields)
    {
        Auth::user()->person->update($fields);
    }
}
