<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        //TODO

        return redirect()->route('users.index')->with('message','Usuario Creado');
    }

    public function update(Request $request, User $user)
    {
        //TODO

        return redirect()->route('users.index')->with('message','Usuario Actualizado');
    }

    public function delete(Request $request, User $user)
    {
        //TODO

        return redirect()->route('users.index')->with('message','Usuario Actualizado');
    }
}