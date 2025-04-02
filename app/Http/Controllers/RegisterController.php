<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'about' => 'nullable|string|max:500',
            'phone' => 'required|numeric|digits:10',
            'designation' => 'required',
            'specialization' => 'required',
            'address' => 'required|string|max:255',
            'profile_photo' => 'required|mimes:jpg,jpeg,png,svg,gif,webp|max:1000',
        ]);

        try {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            $data->role = $request->role;
            $data->about = $request->about;
            $data->phone = $request->phone;
            $data->designation = $request->designation;
            $data->specialization = $request->specialization;
            $data->address = $request->address;

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $fileImageName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profile'), $fileImageName);
                $data->profile_photo_url = 'uploads/profile/' . $fileImageName;
            }

            $data->save();
            DB::commit();
            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('failure', 'Registration failed: ' . $e->getMessage());
        }
    }
}

