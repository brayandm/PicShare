<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class AdminController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsers()
    {
        return view('users.show', ['users' => $this->userService->getAll()]);
    }

    public function deleteUser($id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.show');
    }
}
