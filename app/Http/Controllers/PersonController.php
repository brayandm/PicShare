<?php

namespace App\Http\Controllers;

use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function followPerson($id)
    {
        $this->personService->followPerson($id);

        return redirect()->back();
    }

    public function unfollowPerson($id)
    {
        $this->personService->unfollowPerson($id);

        return redirect()->back();
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

    public function getToken()
    {
        $token = $this->personService->generateToken();

        return view('profile.token', ['token' => $token]);
    }

    public function getApiDocs()
    {
        return redirect('/api/docs');
    }
}
