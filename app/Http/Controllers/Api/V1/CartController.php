<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        
        $newCarts = $request->session()->get('carts') ?? [];
        
        $cartIds = array_keys($newCarts);
        $cartProducts = ProductVariant::select('id','stock_quantity', 'price', 'discount_percent' )
                                ->whereIn('id', $cartIds)
                                ->get();
        $subTotal = 0;
        
        foreach ($cartProducts as $variant) {
            $variant->quantity_in_cart = $newCarts[$variant->id]['quantity'];
            $subTotal += priceAfterDiscount( $variant ) * $variant->quantity_in_cart;
        } 
 
        return response()->json([
            'items_count'   => $cartProducts->count() ?? 0,
            'items_detail'  => $cartProducts,
            'total'         => (int) $subTotal ?? 0,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::alert($request->all());
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
        Log::debug([ "updateCart - ", $request->all() ]);

        $validator = $request->validate([
            'variantId' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
        $variantId = $request->input('variantId'); 
        $cartQuantity = $request->input('quantity'); 
        $maxSkuItems = $request->input('maxSkuItems') ?? 50; 
        
        if ($cartQuantity > $maxSkuItems) {
            $cartQuantity = $maxSkuItems;
        }
        
        // Log::debug([ "sessions = " , session()->all() ]);


        $carts = $request->session()->get('carts', []);



        if ( isset( $carts[$variantId] ) ) {
            if( $cartQuantity > 0) {
                $carts[$variantId]['quantity'] = $cartQuantity;
            }
            else{
                unset($carts[$variantId]);
            }
        }
        else {
            // $product = Product::findOrFail($productId);
            $carts[$variantId] = [
                // 'name'  => $product->fullname_vi,
                'quantity' => $cartQuantity,
            ];
        }
        $request->session()->put('carts', $carts );


        $newCarts = $request->session()->get('carts') ?? [];
        $cartIds = array_keys($newCarts);
        $cartProducts = ProductVariant::select('id','stock_quantity', 'price', 'discount_percent' )
                                ->whereIn('id', $cartIds)
                                ->get();
        $subTotal = 0;
        foreach ($cartProducts as $variant) {
            $variant->quantity_in_cart = $newCarts[$variant->id]['quantity'];
            $subTotal += priceAfterDiscount( $variant ) * $variant->quantity_in_cart;
        } 
        
 
        return response()->json([
            'items_count'   => $cartProducts->count() ?? 0,
            'items_detail'  => $cartProducts,
            'total'         => (int) $subTotal ?? 0,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function addToCart(Request $request, $variantId)
    // {
    //     $carts = $request->session()->get('carts', []);

    //     if ( isset( $carts[$variantId] ) ) {
    //         $carts[$variantId]['quantity'] += 1;
    //     } 
    //     else {
    //         // $product = Product::findOrFail($productId);
    //         $carts[$variantId] = [
    //             // 'name'  => $product->fullname_vi,
    //             'quantity' => 1,
    //         ];
    //     }


    //     $request->session()->put('carts', $carts );
    //     // session()->put('carts', $carts );
    //     // Session::put('carts', $carts );

    //     $newCarts = $request->session()->get('carts') ?? [];
    //     $cartCount = count($newCarts);
    //     return response()->json([
    //         'status'    => 'success',
    //         'cartCount' => $cartCount,
    //     ]);
    // }

    public function clearCart()
    {
        session()->forget('carts');
        return response()->json([
            'status'    => 'success',
        ]);
    }

    function getCartProducts(Request $request)
    {   
        $newCarts = $request->session()->get('carts') ?? [];
        $cartIds = array_keys($newCarts);
        // $cartProducts = DB::table('products')
        //                     ->join('product_variants', 'products.id', '=', 'product_variants.product_id')    
        //                     // ->select('id', 'quantity', 'price', 'discount_percent' )
        //                     ->select(
        //                         'products.id AS product_id', // Alias cho products.id
        //                         'product_variants.id AS variant_id', // Alias cho variants.id
        //                         'fullname_vi',
        //                         'variant_title',
        //                         'products.unit AS product_unit',
        //                         'price',
        //                         'discount_percent',
        //                         'stock_quantity',
        //                     )
        //                     ->whereIn('product_variants.id', $cartIds)
        //                     ->get();


        $cartProducts = ProductVariant::whereIn('id', $cartIds)->get();
        // Log::debug($cartProducts);
        $subTotal = 0;

        // $cartProducts = processProducts($cartProducts);
        foreach ($cartProducts as $product) {
            $product->quantity_in_cart = $newCarts[$product->id]['quantity'];
            $subTotal += priceAfterDiscount( $product ) * $product->quantity_in_cart;
        } 
 

        $responseProducts = $cartProducts->map(function ($variant) {
            $title = $variant->product->fullname_vi;
            if ($variant->variant_title) {
                $title .= " - " . $variant_title;
            }
            return [
                'variant_id' => $variant->id,
                'title' => $title,
                'price' => $variant->price,
                'discount_percent' => $variant->discount_percent,
                'new_price' => priceAfterDiscount( $variant ),
                'stock_quantity' => $variant->stock_quantity, // Số lượng hàng tồn    
                'url_detail_product' => '/' . $variant->product->categories()->first()->slug . "/" . $variant->product->slug,
                'thumbnail' => $variant->product->photos->first() ? $variant->product->photos->first()->path : "", // Lấy danh sách URL của ảnh
                'quantity_in_cart' => $variant->quantity_in_cart,
            ];
        });
        Log::debug($responseProducts);
        return response()->json([
            'items_count'   => $cartProducts->count() ?? 0,
            'items_detail'  => $responseProducts,
            'total'         => (int) $subTotal ?? 0,
        ], 200);
    }





}
