<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index() {

        $chinaCategories = Category::with('products')->where('parent_id', '1')->get();
        
        return view('frontend.home.index', compact('chinaCategories'  ) );
    }

    public function liveSearch(Request $request) {
        $keyText = $request->input('live_search');
        $searchProducts = Product::where('name', 'LIKE', '%'.$keyText.'%')->get();
        return response()->json($searchProducts);
    }

}
