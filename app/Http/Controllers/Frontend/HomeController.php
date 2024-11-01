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
        $keyText = $request->get('key_search');
        // dd($request->all()   );
        $searchProducts = Product::where('name', 'LIKE', '%'.$keyText.'%')->get()->take(6);
        // return response()->json($searchProducts);
        // return view('frontend.layouts.live-search', compact('searchProducts') );
        return response()->json([
            'status' => 'success',
            'message' => 'Order created successfully!',
            // 'order' => $order,
            'searchHtml' => view('frontend.layouts.live-search', compact('searchProducts') )->render()  ,
        ], 201);

    }
 
}
