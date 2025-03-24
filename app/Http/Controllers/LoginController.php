<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required|string|min:6',
            // 'role' => 'required|in:admin,user',
        ]);

        // if(Auth::attempt($request->only('email','password'))){
        //     // dd(Auth::check());
        //     return redirect()->route('index')->with('success','profile login successfull');
        // }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['login_error' => 'Invalid credentials!']);
        }
        
        $guard = $user->role === 'admin' ? 'web' : 'user';
        if (Auth::guard($guard)->attempt($request->only('email', 'password'))) {
            $guard = Auth::guard('web')->check() ? 'web' : 'user';
           if($guard === 'web')
           {
            return redirect()->route('index')->with('success','admin login successfull');
           }else{
            return redirect()->route('profiles')->with('success','user login successfull');
           }
        }
        return redirect()->back()->withErrors(['login_error' => 'Invalid credentials!']);
    }


    public function logout()
    {
        $guard = Auth::guard('web')->check() ? 'web' : 'user';
        Auth::guard($guard)->logout();
        return redirect()->route('login')->with('success','logged out successfully');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'. Auth::id(),
            'photo_profile_url' => 'mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
        ]);

        $user = Auth::user();
    try {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo_url')) {
            $file = $request->file('profile_photo_url');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $fileName);
            $user->profile_photo_url = 'uploads/profile/' . $fileName;
        }
        
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['update_error' => 'Failed to update profile']);
    }    
    }

    public function password()
    {
        return view('password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password))
        {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
        }
    
        try {
            $user->password = bcrypt($request->password);
            $user->save();
    
            return redirect()->route('profile')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['update_error' => 'Failed to update password']);
        }
    }
}
