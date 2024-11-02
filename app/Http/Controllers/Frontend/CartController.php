<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        
        dump($request->session()->get('carts', []) );
    }
    public function showCart(Request $request)
    {
        $carts = session()->get('carts', []);
        $cartIds = array_keys($carts);
        $cartProducts = Product::whereIn('id', $cartIds)->get();
        $totalAmountAfterDiscount = calTotalAmountAfterDiscount ( $cartProducts, $carts );
        $shippingFee = 0;
        
        return view('frontend.cart.show-cart', compact('cartProducts', 'totalAmountAfterDiscount', 'shippingFee' ) );
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

    function headerCartReload(Request $request) 
    {
        $carts = session()->get('carts', []);
        $cartIds = array_keys($carts);
        $cartProducts = Product::whereIn('id', $cartIds)->get();
        $totalAmountAfterDiscount = calTotalAmountAfterDiscount ( $cartProducts, $carts );

        return view('frontend.cart.hover-header-cart', compact('cartProducts', 'totalAmountAfterDiscount' ) );
    }
 
    function updateCart(Request $request)
    {   
        $validator = $request->validate([
            'prd' => 'required|integer|min:0',
            'qty' => 'required|integer|min:0',
        ]);
        $productId = $request->input('prd'); 
        $cartQuantity = $request->input('qty'); 
        $carts = $request->session()->get('carts', []);

        if ( isset( $carts[$productId] ) ) {
            if( $cartQuantity > 0) {
                $carts[$productId]['quantity'] = $cartQuantity;
            }
            else{
                unset($carts[$productId]);
            }
            $request->session()->put('carts', $carts );
        }

        $newCarts = $request->session()->get('carts') ?? [];
        $cartIds = array_keys($newCarts);
        $cartProducts = Product::whereIn('id', $cartIds)->get();
        $totalAmountAfterDiscount = calTotalAmountAfterDiscount ( $cartProducts, $carts );
        $totalAmountAfterDiscountText =  convertMoneyToStr($totalAmountAfterDiscount);

        $totalAmountAfterDiscountTextTmp = $totalAmountAfterDiscountText;


        $cartCount = count($newCarts);
        return response()->json([
            'status'    => 'success',
            'cartCount' => $cartCount,
            'totalAmountAfterDiscountTextTmp'  => $totalAmountAfterDiscountTextTmp,
            'totalAmountAfterDiscountText'  => $totalAmountAfterDiscountText,
            'shippingFee'   => 0,
        ]);
    }

    

    function showDetailCartContent(Request $request) {
        $carts = session()->get('carts', []);
        $cartIds = array_keys($carts);
        $cartProducts = Product::whereIn('id', $cartIds)->get();
        $totalAmountAfterDiscount = calTotalAmountAfterDiscount ( $cartProducts, $carts );
        $shippingFee   = 0;

        return view('frontend.cart.show-cart-list', compact( 'cartProducts' , 'totalAmountAfterDiscount', 'shippingFee' ) );
    }

    function showCartOrder(Request $request) {
        $carts = session()->get('carts', []);
        $cartIds = array_keys($carts);
        $cartProducts = Product::whereIn('id', $cartIds)->get();
        $totalAmountAfterDiscount = calTotalAmountAfterDiscount( $cartProducts, $carts );
        $shippingFee   = 0;

        return view('frontend.cart.cart-order', compact( 'cartProducts' , 'totalAmountAfterDiscount' , 'shippingFee' ) );
    }

}


