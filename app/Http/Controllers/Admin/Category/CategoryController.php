<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function adminCategoryList()
    {
        $category_lists = Category::where('status', 1)->latest()->get();
        return view('admin.pages.category.category_list', compact('category_lists'));
    }
    public function adminCategoryStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'category_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);
            $category = new Category();
            if ($request->hasFile('category_image')) {
                $category_image = $request->file('category_image');
                $category_image_name = 'category_images_' . time() . '.' . $category_image->getClientOriginalExtension();
                $category_image->move(public_path('admin/category/'), $category_image_name);
                $category->category_image = $category_image_name;
            }
            $category->category_name = $validatedData['category_name'];
            $category->meta_tag = $validatedData['meta_tag'];
            $category->meta_description = $validatedData['meta_description'];
            $category->save();
            return redirect()->back()->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    public function categoryContent(Request $request, $id)
    {
        $category_content = Category::where('id', $id)->first();
        return view('admin.pages.category.category_content', compact('category_content'));
    }

    public function adminCategoryUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'category_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'category_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);
            $category = Category::findOrFail($id);
            $category->category_name = $validatedData['category_name'];
            $category->meta_tag = $validatedData['meta_tag'];
            $category->meta_description = $validatedData['meta_description'];
            if ($request->hasFile('category_image')) {
                if ($category->category_image !== null) {
                    Storage::delete('admin/category/' . $category->category_image);
                }
                $category_image = $request->file('category_image');
                $category_image_name = 'category_images_' . time() . '.' . $category_image->getClientOriginalExtension();
                $category_image->move(public_path('admin/category/'), $category_image_name);
                $category->category_image = $category_image_name;
            }
            $category->save();
            return redirect()->back()->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function adminCategoryDelete(Request $request)
    {
        $id = $request->input('categoryId');
        try {
            $category = Category::findOrFail($id);
            $category->update(['status' => 0]);
            // Returning JSON response
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting category: ' . $e->getMessage()], 500);
        }
    }



}
