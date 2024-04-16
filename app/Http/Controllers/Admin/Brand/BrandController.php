<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function adminBrandList()
    {
        $category_lists = Category::where('status', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('subcategories')
                    ->whereRaw('subcategories.category_id = categories.id');
            })
            ->latest()
            ->get();

        $subcategory_lists = Subcategory::where('status', 1)->latest()->get();
        $brand_lists = Brand::where('status', 1)->latest()->get();

        return view('admin.pages.brand.brand_list', compact('category_lists', 'subcategory_lists', 'brand_lists'));
    }
    public function adminBrandStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);

            $brand = new Brand();
            $brand->category_id = $validatedData['category_id'];
            $brand->subcategory_id = $validatedData['subcategory_id'];
            $brand->brand_name = $validatedData['brand_name'];
            $brand->meta_tag = $validatedData['meta_tag'];
            $brand->meta_description = $validatedData['meta_description'];
            $brand->save();

            return redirect()->back()->with('success', 'Brand created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }
    public function brandContent(Request $request, $id)
    {
        $brand_content = Brand::where('id', $id)->first();
        $category_lists = Category::where('status', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('subcategories')
                    ->whereRaw('subcategories.category_id = categories.id');
            })
            ->latest()
            ->get();
        $subcategory_lists = Subcategory::where('status', 1)->latest()->get();
        return view('admin.pages.brand.brand_content', compact('brand_content', 'category_lists', 'subcategory_lists'));
    }
    public function brandUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_name' => 'required',
                'meta_tag' => 'required',
                'meta_description' => 'required',
            ]);

            $brand = Brand::findOrFail($id);
            $brand->category_id = $validatedData['category_id'];
            $brand->subcategory_id = $validatedData['subcategory_id'];
            $brand->brand_name = $validatedData['brand_name'];
            $brand->meta_tag = $validatedData['meta_tag'];
            $brand->meta_description = $validatedData['meta_description'];
            $brand->save();

            return redirect()->back()->with('success', 'Brand updated successfully.');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }

    public function AdminbrandDelete(Request $request)
    {
        $id = $request->input('brandId');
        try {
            $brand = Brand::findOrFail($id);
            $brand->update(['status' => 0]);
            return response()->json(['message' => 'Brand deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting Brand: ' . $e->getMessage()], 500);
        }

    }

}
