<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {

        echo '<div>tanhongfood.com</div>';
        return ;
        // return view('frontend.home.copy' );
        return view('frontend.home.index' );
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
