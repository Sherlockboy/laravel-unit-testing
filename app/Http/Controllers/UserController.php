<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UserSearchRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('index');
    }

    public function search(UserSearchRequest $request, )
    {
        try {
            $user = $this->service->search($request->user_id);
        } catch (UserNotFoundException $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('search', compact('user'));
    }
}
