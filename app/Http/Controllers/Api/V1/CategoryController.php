<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::Where('parent_id', '1' )->get();
        if (!$categories) {
            return response()->json(['message' => 'No categories found'], 404);
        }
        
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getHomeCategoryProduct(Request $request) {
        //
        $categories = Category::Where('parent_id', '1' )->get();
        if (!$categories) {
            return response()->json(['message' => 'No categories found'], 404);
        }
        $res = [];
        foreach ($categories as $cate ) {
            $item = new \stdClass();

            $item->category = $cate->only("id" , "name", "slug");
            $prds = processProducts($cate->products()->orderBy('created_at', 'desc')->take(12)->get());
            $prds = $prds->map(function ($product) {
                return [
                    'id'    => $product->id,
                    'name' => $product->name_vi,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'first_photo' => $product->first_photo,
                    'url_detail_product' => $product->url_detail_product,
                    'new_price' => $product->new_price,
                    'cart_quantity' => $product->cart_quantity,
                    'quantity'  => $product->quantity,
                ];
            });
            
            $item->products = $prds;

            $res[] = $item;
        }
        
        return response()->json($res, 200);
    }
}
