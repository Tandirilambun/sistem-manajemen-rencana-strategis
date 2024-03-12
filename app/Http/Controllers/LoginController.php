<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class LoginController extends Controller
{
    protected $firebaseAuth;
    
    public function __construct(){
        $this->firebaseAuth = Firebase::auth();
    }
    
    public function showLogin()
    {
        return view('Login.login');
    }

    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        try{
            $signInResult = $this->firebaseAuth->signInWithEmailAndPassword($credential['email'], $credential['password']);
            if($signInResult && Auth::attempt($request -> only('email', 'password'))){
                $request->session()->regenerate();
                return redirect()->intended('/home') -> with('login_success','Login Successfully');
            }
        }catch(\Kreait\Firebase\Exception\Auth\InvalidPassword $e){
            return response()->json(['error' => 'INVALID PASSWORD'], 401);
        }catch(\Kreait\Firebase\Exception\Auth\UserNotFound $e){
            return response()->json(['error' => 'User Not Found'], 401);
        }catch(\Exception $e){
            return response()->json(['error' => 'Authentication Failed'], 401);
        }
        return back()->with('loginFailed', 'Login failed! Username/Email atau Password Salah!');

    }
    public function logoutUser()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
