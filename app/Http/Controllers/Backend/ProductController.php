<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //

    public function index() {
        $products = Product::all();
        Log::debug($products->first());
        return view('backend.admin.product.index', compact('products') );
    }
}
