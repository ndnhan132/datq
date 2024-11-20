<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
 
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newCarts = $request->session()->get('carts') ?? [];
        $cartIds = array_keys($newCarts);
        $cartProducts = Product::select('id', 'quantity', 'price', 'discount' )
                                ->whereIn('id', $cartIds)
                                ->get();
        $subTotal = 0;
        
        foreach ($cartProducts as $product) {
            $product->cartQuantity = $newCarts[$product->id]['quantity'];
            $subTotal += priceAfterDiscount( $product ) * $product->cartQuantity;
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
        // Log::debug([ "updateCart - ", $request->all() ]);

        $validator = $request->validate([
            'productId' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
        $productId = $request->input('productId'); 
        $cartQuantity = $request->input('quantity'); 
        $maxSkuItems = $request->input('maxSkuItems') ?? 50; 
        
        if ($cartQuantity > $maxSkuItems) {
            $cartQuantity = $maxSkuItems;
        }
        
        Log::debug([ "sessions = " , session()->all() ]);


        $carts = $request->session()->get('carts', []);



        if ( isset( $carts[$productId] ) ) {
            if( $cartQuantity > 0) {
                $carts[$productId]['quantity'] = $cartQuantity;
            }
            else{
                unset($carts[$productId]);
            }
        }
        else {
            $product = Product::findOrFail($productId);
            $carts[$productId] = [
                'name'  => $product->name_vi,
                'quantity' => $cartQuantity,
            ];
        }
        $request->session()->put('carts', $carts );


        $newCarts = $request->session()->get('carts') ?? [];
        $cartIds = array_keys($newCarts);
        $cartProducts = Product::select('id','quantity', 'price', 'discount' )
                                ->whereIn('id', $cartIds)
                                ->get();
        $subTotal = 0;
        foreach ($cartProducts as $product) {
            $product->cartQuantity = $newCarts[$product->id]['quantity'];
            $subTotal += priceAfterDiscount( $product ) * $product->cartQuantity;
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

    public function addToCart(Request $request, $productId)
    {
        $carts = $request->session()->get('carts', []);

        if ( isset( $carts[$productId] ) ) {
            $carts[$productId]['quantity'] += 1;
        } 
        else {
            $product = Product::findOrFail($productId);
            $carts[$productId] = [
                'name'  => $product->name,
                'quantity' => 1,
            ];
        }


        $request->session()->put('carts', $carts );
        // session()->put('carts', $carts );
        // Session::put('carts', $carts );

        $newCarts = $request->session()->get('carts') ?? [];
        $cartCount = count($newCarts);
        return response()->json([
            'status'    => 'success',
            'cartCount' => $cartCount,
        ]);
    }

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
        $cartProducts = Product::whereIn('id', $cartIds)
                                // select('id', 'quantity', 'price', 'discount' )
                                ->get();
        $subTotal = 0;
        $cartProducts = processProducts($cartProducts);
        foreach ($cartProducts as $product) {
            // $product->cartQuantity = $newCarts[$product->id]['quantity'];
            $subTotal += priceAfterDiscount( $product ) * $product->cartQuantity;
        } 
 
        return response()->json([
            'items_count'   => $cartProducts->count() ?? 0,
            'items_detail'  => $cartProducts,
            'total'         => (int) $subTotal ?? 0,
        ], 200);
    }


}
