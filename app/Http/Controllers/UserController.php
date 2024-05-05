<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('authorization/register', $data);
    }

    // UserController.php

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'role' => 'required|in:admin,manager,staff',
            'division' => 'required|in:ADMIN,PRODUCT ENGINEERING,PRODUCT DESIGN',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'division' => $request->division,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }




    public function login()
    {
        $data['title'] = 'Login';
        return view('authorization/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data['title'] = 'Profile';
        $data['user'] = $user;
        $data['users'] = User::all();

        return view('authorization.profile', $data);
    }

    public function edit_profile()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $data['title'] = 'Edit Profile';
    $data['user'] = $user;

    return view('authorization.profile', $data);
}

public function update_profile(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    $request->validate([
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;

    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}


    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
        $user->delete();
        return redirect()->route('profile')->with('success', 'User deleted successfully!');
    }
}
