<?php

namespace App\Http\Controllers;

use App\Services\PersonService;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    private PersonService $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function get()
    {
        return view('profile.show', ['person' => $this->personService->get()]);
    }

    public function getPerson($id)
    {
        return view('profiles.show', ['person' => $this->personService->getPerson($id)]);
    }

    public function edit()
    {
        return view('profile.edit', ['person' => $this->personService->get()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'description' => 'max:255',
            'birthdate' => 'date',
        ]);

        $this->personService->update($validated);

        return redirect()->route('profile.show');
    }
}
