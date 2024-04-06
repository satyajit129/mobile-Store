<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
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

        return view('admin.pages.brand.brand_list', compact('category_lists', 'subcategory_lists'));
    }
}
