<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('deleted', false)->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        abort_unless(Auth::user()->role->name == 'admin' || Auth::user()->id == $user->id ,403);
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        //TODO

        return redirect()->route('users.index')->with('message','Usuario Creado');
    }

    public function update(Request $request, User $user)
    {
        abort_unless(Auth::user()->role->name == 'admin' || Auth::user()->id == $user->id ,403);
        $fields = $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $user->update($fields);

        return redirect()->route('users.index')->with('message','Usuario Actualizado');
    }

    public function delete(User $user)
    {
        abort_if(Auth::user()->role->name != 'admin' || $user->role->name == 'admin', 403);

        $user->update(['deleted' => true]);

        return redirect()->route('users.index')->with('message','Usuario Eliminado');
    }
}