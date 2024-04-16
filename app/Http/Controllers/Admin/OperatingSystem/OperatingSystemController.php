<?php

namespace App\Http\Controllers\Admin\OperatingSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;

class OperatingSystemController extends Controller
{
    public function adminOperatingSystemList()
    {
        $category_lists = Category::where('status', 1)->latest()->get();
        $operating_system_lists = OperatingSystem::where('status', 1)->latest()->get();
        return view('admin.pages.operatingsystem.operating_system_list', compact('category_lists', 'operating_system_lists'));
    }
    public function adminOperatingSystemStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'operating_system_name' => 'required',
                'meta_tag' => 'nullable',
                'meta_description' => 'nullable',
            ]);
            $operatingSystem = new OperatingSystem();
            $operatingSystem->category_id = $validatedData['category_id'];
            $operatingSystem->operating_system_name = $validatedData['operating_system_name'];
            $operatingSystem->meta_tag = $validatedData['meta_tag'];
            $operatingSystem->meta_description = $validatedData['meta_description'];
            $operatingSystem->save();
            return redirect()->back()->with('success', 'Operating System created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Operating System: ' . $e->getMessage());
        }
    }
    public function operatingSystemContent(Request $request, $id)
    {
        $category_lists = Category::where('status', 1)->get();
        $operating_system_list = OperatingSystem::where('id', $id)->first();
        return view('admin.pages.operatingsystem.operating_system_content', compact('operating_system_list', 'category_lists'));
    }
    public function adminOperatingSystemUpdate(Request $request, $id){
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'operating_system_name' => 'required',
                'meta_tag' => 'nullable',
                'meta_description' => 'nullable',
            ]);
            $operatingSystem = OperatingSystem::findOrFail($id);
            $operatingSystem->category_id = $validatedData['category_id'];
            $operatingSystem->operating_system_name = $validatedData['operating_system_name'];
            $operatingSystem->meta_tag = $validatedData['meta_tag'];
            $operatingSystem->meta_description = $validatedData['meta_description'];
            $operatingSystem->save();
            return redirect()->back()->with('success', 'Operating System Updated successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    public function adminOperatingSystemDelete(Request $request){
        $id = $request->input('operatingSystemID');
        try {
            $operating_system = OperatingSystem::findOrFail($id);
            $operating_system->update(['status' => 0]);
            return response()->json(['message' => 'Operating System deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting Operating System: ' . $e->getMessage()], 500);
        }
    }
}
