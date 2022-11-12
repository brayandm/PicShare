<?php

namespace App\Http\Controllers;

use App\Services\PersonService;

class PersonController extends Controller
{
    private PersonService $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function getProfile()
    {
        return view('profile', ['person' => $this->personService->getPerson()]);
    }
}
