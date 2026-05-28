<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH USER
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $users = $query
            ->latest()
            ->paginate(10);

        return view(
            'users.index',
            compact('users')
        );
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([

            'name' =>
            'required',

            'email' =>
            'required|email|unique:users',

            'password' =>
            'required|min:6',

            'role' =>
            'required',

            'photo' =>
            'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $photo = null;

        /*
    |--------------------------------------------------------------------------
    | UPLOAD PHOTO
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('photo')) {

            $photo = $request
                ->file('photo')
                ->store(
                    'profiles',
                    'public'
                );
        }

        User::create([

            'name' =>
            $request->name,

            'email' =>
            $request->email,

            'password' =>
            Hash::make(
                $request->password
            ),

            'role' =>
            $request->role,

            'photo' =>
            $photo

        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
    }
    public function edit(User $user)
    {
        return view('users.edit', [

            'user' => $user

        ]);
    }
    public function update(
        Request $request,
        User $user
    ) {
        $request->validate([

            'name' =>
            'required',

            'email' =>
            'required|email'

        ]);

        if ($request->hasFile('photo')) {

            $user->photo = $request
                ->file('photo')
                ->store(
                    'profiles',
                    'public'
                );
        }

        $user->name =
            $request->name;

        $user->email =
            $request->email;

        $user->role =
            $request->role;

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diupdate'
            );
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus'
            );
    }
}
