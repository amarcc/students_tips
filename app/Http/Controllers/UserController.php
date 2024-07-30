<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this -> authorizeResource(User::class);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required|min:2',
            'email' => 'unique:users|email|required',
        ]);
        
        $request -> validate([
            'password' => 'required|min:8',
            'rep_password' => 'required|min:8',
        ]);
        
        if($request -> input('password') !== $request -> input('rep_password')){
            return redirect() -> back() -> with('error', 'Passwords are not the same');
        }

        $newpass = Hash::make($request -> input('password'));

        Auth::check() && auth() -> user() -> admin ? $admin = $request -> filled('admin') : $admin = false;

        $user = User::create([
            ...$validatedData,
            'password' => $newpass,
            'admin' => $admin
        ]);

        $remember = $request -> filled('remember');

        Auth::login($user, $remember);

        return redirect() -> intended('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => auth() -> user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = auth() -> user();
        $validatedData = $request -> validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' . $user -> id
        ]);

        $password = $request -> input('password');

        if($password !== null ){
            $request -> validate([
                'password' => 'required|string|min:8',
                'rep_password' => 'required|string|min:8'
            ]);
            if($password === $request -> input('rep_password')){
                $newpass = Hash::make($request -> input('password'));
                $user -> update([
                    ...$validatedData,
                    'password' => $newpass,
                ]);
            } else {
                return redirect() -> back() -> with('error', 'Passwords are not the same');
            }
        } else {
            $user -> update([
                ...$validatedData
            ]);
        }

        Auth::login($user, true);

        return redirect() -> intended('/') -> with('success', 'Account updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) 
    {
        Auth::logout();

        request() -> session() -> invalidate();
        request() -> session() -> regenerateToken();

        $user -> delete();

        return redirect() -> route('faculties.index') -> with('success', 'Account deleted successfully');
    }
}
