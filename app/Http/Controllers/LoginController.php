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
        ]);


        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No Account Found This Email!'])->withInput();
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
        return redirect()->back()->withErrors(['password' => 'Incorrect Password']);
    }


    public function logout()
    {
        $guard = Auth::guard('web')->check() ? 'web' : 'user';
        Auth::guard($guard)->logout();
        return redirect()->route('login')->with('success','logged out successfully');
    }

    public function profile()
    {

        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }

        return view('profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if (!$user) {
            return redirect()->back()->withErrors(['update_error' => 'User not authenticated']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_photo_url' => 'mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
        ]);

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
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['update_error' => 'Failed to update profile']);
        }
    }

    public function password()
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();
    
        if (!$user) { 
            return redirect()->route('login')->withErrors(['update_error' => 'User not authenticated']);
        }
    
        return view('password', compact('user'));
    }

    
    public function update_password(Request $request)
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();
    
        if (!$user) {
            return redirect()->route('login')->withErrors(['update_error' => 'User not authenticated']);
        }
    
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
        }
    
        try {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route(
                Auth::guard('web')->check() ? 'admin.profile' : 'user.profile'
            )->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['update_error' => 'Failed to update password']);
        }
    }
    
    public function forgetPasswordForm()
    {
        return view('forget_password');
    }

    public function forgetPassword(Request $request)
    {
       $request->validate([

        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:6|confirmed',
       ]);

       try{
        $user = User::where('email' , $request->email)->first();
        if(!$user){
            return back()->withErrors(['email' => 'No Account Found this Email']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        if($user->role == 'admin'){
            return redirect()->route('login')->with('success', 'password set successfully');
        }else{
            return redirect()->route('login')->with('success', 'password set successfully');
        }
       } catch(Exception $e) {
        //$e->getMessage();
        return back()->withErrors(['error' => 'something went wrong please try again ']);
       }
    }
}
