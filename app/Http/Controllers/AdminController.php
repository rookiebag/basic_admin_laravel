<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully', 
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.profile', compact('adminData'));
    }
    
    public function editProfile(){

        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.editProfile',compact('editData'));
    }// End Method 

    /**
     * Update login user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->username  = $request->username;

        if($request->file('profile_image')){
            $profileImage = $id.'_profile.'.$request->file('profile_image')->extension();
            $request->file('profile_image')->move(public_path('adminProfiles'), $profileImage);
            $user->profile_pic  = $profileImage;
        }

        $user->save();

        // return redirect()->route('admin.profile');
        // return back()->with('success', 'Profile Updated');
        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function ChangePassword()
    {

        return view('admin.admin_change_password');

    }// End Method


    public function UpdatePassword(Request $request)
    {
        $validateDate = $request->validate([
            'oldpassword' => ['required'],
            'newpassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
    
            $notification = array(
                'message' => 'Password Updated Successfully', 
                'alert-type' => 'info'
            );
    
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Password doesn\'t match', 
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }//
}
