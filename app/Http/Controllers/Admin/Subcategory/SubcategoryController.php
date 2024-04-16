<?php

namespace App\Http\Controllers\Admin\Subcategory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function adminSubcategoryList()
    {
        $category_lists = Category::where('status', 1)->latest()->get();
        $subcategory_lists = Subcategory::where('status', 1)->latest()->get();
        return view('admin.pages.subcategory.subcategory_list', compact('category_lists', 'subcategory_lists'));
    }
    public function adminSubcategoryStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'subcategory_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);
            $subcategory = new Subcategory();
            $subcategory->category_id = $validatedData['category_id'];
            $subcategory->subcategory_name = $validatedData['subcategory_name'];
            $subcategory->meta_tag = $validatedData['meta_tag'] ?? null;
            $subcategory->meta_description = $validatedData['meta_description'] ?? null;
            $subcategory->save();
            return redirect()->back()->with('success', 'Subcategory created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function subcategoryContent(Request $request, $id)
    {
        $category_lists = Category::where('status', 1)->get();
        $subcategory_content = Subcategory::where('id', $id)->first();
        return view('admin.pages.subcategory.subcategory_content', compact('subcategory_content', 'category_lists'));
    }
    public function adminSubcategoryUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'subcategory_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->category_id = $request->category_id;
            $subcategory->subcategory_name = $request->subcategory_name;
            $subcategory->meta_tag = $request->meta_tag;
            $subcategory->meta_description = $request->meta_description;
            $subcategory->save();
            return redirect()->back()->with('success', 'Subcategory updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function adminSubcategoryDelete(Request $request){
        $id = $request->input('subcategoryId');
        try {
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->update(['status' => 0]);
            return response()->json(['message' => 'Subcategory deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting Subategory: ' . $e->getMessage()], 500);
        }
    }
}
