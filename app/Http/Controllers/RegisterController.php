<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends Controller
{
    protected $firebaseAuth;
    
    public function __construct(){
        $this->firebaseAuth = Firebase::auth();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request -> validate([
            'name' => 'required',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        $user_firebase = $this->firebaseAuth->createUserWithEmailAndPassword($validated['email'], $request->input('password'));
        if($user_firebase){
            Users::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'STAFF',
            ]);
        }
        return redirect ('/login') -> with('success', 'Registered Successfully');
    }
    public function showRegister(){
        return view('Login.register');
    }
}
