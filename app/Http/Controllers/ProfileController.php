<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $request->validate([

            'name' =>
            'required',

            'email' =>
            'required|email',

            'photo' =>
            'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | UPLOAD PHOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $path = $request
                ->file('photo')
                ->store(
                    'profiles',
                    'public'
                );

            $user->photo = $path;
        }

        $user->name =
        $request->name;

        $user->email =
        $request->email;

        $user->save();

        return back()->with(
            'success',
            'Profile berhasil diupdate'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $request->validate([

            'password' =>
            'required|min:6|confirmed'

        ]);

        $user = auth()->user();

        $user->password =
        Hash::make($request->password);

        $user->save();

        return back()->with(
            'success',
            'Password berhasil diubah'
        );
    }
}