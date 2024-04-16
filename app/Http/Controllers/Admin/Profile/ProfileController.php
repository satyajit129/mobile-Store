<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function adminProfile()
    {
        $admin_info = User::where('id', auth()->id())->first();
        return view('admin.pages.profile.profile_info', compact('admin_info'));
    }
    public function adminProfileUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string',
                'new_password' => 'nullable|string',
            ]);
            $admin = User::findOrFail($id);
            if (!\Hash::check($request->password, $admin->password)) {
                return redirect()->back()->with('error', 'Old password does not match.');
            }
    
            $admin->name = $validatedData['name'];
            $admin->email = $validatedData['email'];
    
            if ($request->hasFile('picture')) {
                $image = $request->file('picture');
                $imageName = 'images_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/profile/'), $imageName);
                $admin->picture = $imageName;
            }
            if ($request->has('new_password')) {
                $admin->password = bcrypt($validatedData['new_password']);
            }
            $admin->save();
    
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
    
}
