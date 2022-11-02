<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

        return redirect('/');
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
        
    }

}
