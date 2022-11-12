<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PersonService
{
    public function getPerson()
    {
        return Auth::user()->person;
    }
}
