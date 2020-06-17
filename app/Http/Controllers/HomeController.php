<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function userRegister(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        $notification = array(
            'message' => 'User successfully created.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function setting(){
        return view('setting');
    }

    public function editProfile(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::findOrFail($request->id);
        $user->update($request->all());
        $notification = array(
            'message' => 'User successfully updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::findOrFail($request->id);
        $old_password = $request->old_password;

        if (Hash::check($old_password, $user->password)){
            $new_password = Hash::make($request->password);
            $user->update(['password'=>$new_password]);
            $notification = array(
                'message' => 'Login with your new password',
                'alert-type' => 'success'
            );
            Auth::logout();
            return redirect()->route('login')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Old password is incorrect',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function users(){
        $users = User::all()->except(Auth::id());
        return view('users', compact('users'));
    }

    public function userDelete($id){
        User::whereId($id)->delete();
        $notification = array(
            'message' => 'User successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function userEdit($id){
        $user = User::whereId($id)->first();
        return view('edit-user', compact('user'));
    }

    public function userUpdate(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::findOrFail($request->id);
        $user->update($request->all());
        $notification = array(
            'message' => 'User successfully updated.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function userPasswordChange(Request $request){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::findOrFail($request->id);
        $new_password = Hash::make($request->password);
        $user->update(['password'=>$new_password]);
        $notification = array(
            'message' => 'Password Updated with success',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }



}
