<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        abort_unless(Auth::user()->role->name == 'admin' ,403);
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
        $user = $this->validate($request, [
            'name'          => 'required|string|min:10',
            'file_number'   => 'required|unique:users,file_number|string|min:5',
            'email'         => 'required|unique:users,email|email:rfc'
        ]);

        $role_id = $request->input('is_tutor') == 'on' ? User::ROLES['TUTOR'] : User::ROLES['STUDENT'];
        $user['role_id'] = $role_id;
        $user['password'] = Hash::make(Str::random(10));
        $user['from_dashboard'] = true;
        $newUser = User::create($user);

        return redirect()->route('users.index')->with('message','Usuario Creado');
    }

    public function update(Request $request, User $user)
    {
        abort_unless(Auth::user()->role->name == 'admin' || Auth::user()->id == $user->id ,403);
        $fields = $this->validate($request, [
            'name' => 'required|string|min:10',
            'email' => 'required|email:rfc'
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