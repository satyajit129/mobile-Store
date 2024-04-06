<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function adminSettings()
    {
        $settings = Settings::first();
        return view('admin.pages.settings.settings', compact('settings'));
    }
    public function updateSettings(Request $request, $id)
    {
        // dd('ok');
        try {
            $validatedData = $request->validate([
                'website_name' => 'required',
                'website_email' => 'required|email',
                'website_copy_right_text' => 'required',
                'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'about_us' => 'required',
                'terms_condition' => 'required',
                'privacy_policy' => 'required',
            ]);

            // Find the Settings model instance by its ID
            $settings = Settings::findOrFail($id);

            // Update the settings attributes
            $settings->website_name = $validatedData['website_name'];
            $settings->website_email = $validatedData['website_email'];
            $settings->website_copy_right_text = $validatedData['website_copy_right_text'];
            $settings->about_us = $validatedData['about_us'];
            $settings->terms_condition = $validatedData['terms_condition'];
            $settings->privacy_policy = $validatedData['privacy_policy'];

            // Handle uploading of the website logo if provided
            if ($request->hasFile('website_logo')) {
                $logo = $request->file('website_logo');
                $filename = 'website_logo_' . time() . '.' . $logo->getClientOriginalExtension();
                $path = public_path('admin/settings/logo/');
                $logo->move($path, $filename);
                $settings->website_logo = $filename;
            }

            // Save the updated settings
            $settings->save();

            // Redirect back or to a specific route
            return redirect()->route('adminSettings')->with('success', 'Settings updated successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage())->withInput();
        }
    }
}
