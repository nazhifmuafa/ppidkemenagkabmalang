<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rules\Unique;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('superadmin.admins.home', [
            'admins' => User::where('role', 'admin')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'Unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'admin';

        User::create($validatedData);

        return redirect('/dashboard/admins')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        return view('superadmin.admins.show', [
            'admin' => $admin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('superadmin.admins.edit', [
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];

        if ($request->username != $admin->username) {
            $rules['username'] = ['required', 'string', 'min:3', 'max:255', 'unique:users'];
        }

        if ($request->email != $admin->email) {
            $rules['email'] = ['required', 'email', 'unique:users'];
        }

        $validatedData = $request->validate($rules);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role'] = 'admin';

        User::where('id', $admin->id)
            ->update($validatedData);

        return redirect('/dashboard/admins')->with('success', 'Edit Admin Berhasil');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        User::destroy($admin->id);

        return redirect('/dashboard/admins')->with('success', 'Admin berhasil dihapus');
    }

    public function checkUsername(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        $count = User::where('username', 'like', "$slug%")->count();
        
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        return response()->json(['username' => $slug]);
    }
}
