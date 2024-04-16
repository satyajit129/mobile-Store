<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function adminProductList(){
        $product_lists= Product::where('status', 1)->latest()->get();
        return view('admin.pages.product.product_list',compact('product_lists'));
    }
    public function adminCreateProduct() {
        $category_lists = Category::where('status', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('subcategories')
                    ->whereRaw('subcategories.category_id = categories.id')
                    ->whereExists(function ($subquery) {
                        $subquery->select(DB::raw(1))
                            ->from('brands')
                            ->whereRaw('brands.subcategory_id = subcategories.id');
                    });
            })
            ->latest()
            ->get();
    
        $subcategory_lists = Subcategory::where('status', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('brands')
                    ->whereRaw('brands.subcategory_id = subcategories.id');
            })
            ->latest()
            ->get();
    
        $brand_lists = Brand::where('status', 1)->latest()->get();
    
        return view('admin.pages.product.product_create', compact('category_lists', 'subcategory_lists', 'brand_lists'));
    }
    
}
