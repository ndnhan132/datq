<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\User;
use App\Models\ProductVariant;
 
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        echo "OrderController index";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info($request->all());  
        $customerData = $request->input('customerData');
        // Log::alert($customerData );
        $otherRecipient = $request->input('otherRecipient') ?? null;
        // Log::alert($otherRecipient );
 

 

        $carts = session()->get('carts', []);
        $cartIds = array_keys($carts);
        $cartProducts = ProductVariant::whereIn('id', $cartIds)->get();

        $subTotal = calSubtotal ( $cartProducts, $carts );
        $discountTotal = calDiscountTotal ( $cartProducts, $carts );
        $tax = 0;
        $promo = 0;
        $shippingFee = 0;
        $totalPayable = $subTotal - $discountTotal - $tax + $shippingFee - $promo;
        
        
        
        $provinceId = $customerData['address']['province']["id"] ?? null;
        $districtId = $customerData['address']['district']["id"] ?? null;
        $wardId = $customerData['address']['ward']["id"] ?? null;
        $customerAddress = $customerData['address']['customerAddress'] ?? "";
        $provinceName = Province::find($provinceId)->name ?? "";
        $districtName = District::find($districtId)->name ?? "";
        $wardName = Ward::find($wardId)->name ?? "";
        // Log::info($provinceId . "- " . $districtId . "- " . $wardId);
        $customerAddress = $customerAddress . ", " . $wardName . ", " . $districtName . ", " . $provinceName;


        // tạo user với sdt nếu chưa được tạo
        $customerPhone = $customerData['phone'];
        $customerName = $customerData['name'];
        $user = User::where("usr_phone", $customerPhone )->first();

        if (!$user) {
            $user = new User();
            $user->usr_phone    = $customerPhone;
            $user->display_name = $customerName;
            $user->usr_address  = $customerAddress;
            $user->save();
        }
        Log::alert($user);

        $order = new Order();
        $order->customer_id     = $user->id;
        $order->sub_total       = $subTotal;
        $order->discount_total  = $discountTotal;
        $order->tax             = $tax;
        $order->shipping_fee    = $shippingFee;
        $order->total_payable   = $totalPayable;

        // $sessionCustomer = $request->session()->get('customer', []);

        if($customerData['sex'] && strtoupper($customerData['sex']) === 'MALE') {
            $order->gender = 'MALE';
            // $sessionCustomer['gender'] = 'MALE';
        }
        if($customerData['sex'] && strtoupper($customerData['sex']) === 'FEMALE') {
            $order->gender = 'FEMALE';
            // $sessionCustomer['gender'] = 'MALE';
        }
        $order->recipient_name      = $customerName;
        $order->recipient_phone     = $customerPhone;
        $order->recipient_address   = $customerAddress;

        if($otherRecipient && $otherRecipient['sex'] && strtoupper($otherRecipient['sex'] ) == 'MALE') {
            $order->alter_recipient_gender = 'MALE';
            
        }
        if($otherRecipient && $otherRecipient['sex'] &&  strtoupper($otherRecipient['sex'] ) == 'FEMALE') {
            $order->alter_recipient_gender = 'FEMALE';

        }
        if ( $otherRecipient && $otherRecipient['name'] ) {
            $order->alter_recipient_name = $otherRecipient['name'];
        }
        if ( $otherRecipient && $otherRecipient['phone'] ) {
            $order->alter_recipient_phone = $otherRecipient['phone'];
        }


        

        // $sessionCustomer['name'] = $customerData['name'];
        // $sessionCustomer['phone'] = $customerData['phone'];
        // $sessionCustomer['customerAddress'] = $customerData['address']['customerAddress'];

        // $request->session()->put('customer', $sessionCustomer );
        
        $order->order_note = $customerData['order_note'] ?? null;
        // Log::alert($order );
        $order->save();

        foreach ($cartProducts as $cartPrd) {
            $order->productVariants()->syncWithoutDetaching([
                $cartPrd->id => [
                    'quantity' => $carts[$cartPrd->id]['quantity'], // Số lượng sản phẩm
                    'cost_price' => $cartPrd->cost_price,          // Giá vốn
                    'final_price' => priceAfterDiscount($cartPrd), // Giá sau giảm giá
                ],
            ]);
        }
        session()->forget('carts');

        Log::notice("storeOrder : " . $order);
        return response()->json([
            'success' => true,
            'order_id' =>  $order->id,
        ], 201  );



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::select(
            'id',
            'gender',
            'recipient_name',
            'recipient_phone',
            'recipient_address',
            'alter_recipient_gender',
            'alter_recipient_name',
            'alter_recipient_phone',
            'order_note',
            'total_payable',
            'shipping_fee',
            'order_status',
        )->where('id', $id )->first();

        if (!$order) {
            return response()->json([
                'error' => 'Order not found',
            ], 404);
        }


        //  = ProductVariant::whereIn('id', $cartIds)->get();

         $cartProducts = Order::find($id)->productVariants;
        // $products = helperProductsFormatForClient( Order::find($id)->productVariants );
        $resProducts = [];
        foreach ($cartProducts as $variant) {
            $title = $variant->product->fullname_vi;
            if ($variant->variant_title) {
                $title .= " - " . $variant_title;
            }
            $resProducts[] = (object) [
                "fullname_vi" => $title,
                // "fullname_zh" => $product->fullname_zh,
                'link' => '/' . $variant->product->categories()->first()->slug . "/" . $variant->product->slug,
                'thumbnail' => $variant->product->photos->first() ? $variant->product->photos->first()->path : "", // Lấy danh sách URL của ảnh
                "quantity" => $variant->pivot->quantity ?? 0,
            ];
        }     

        $order->products = $resProducts; 
        
        // Log::alert($order);
        return response()->json($order, 200);
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

    public function userConfirm(Request $request) {
        Log::alert($request->all());

        $orderId = $request->input("orderId");
        $paymentMethod = $request->input("paymentMethod");
        if($orderId) {
            $order = Order::find($orderId);
            $order->payment_method = $paymentMethod;
            $order->updateStatus('USER_CONFIRMED');
            $order->save();
            return response()->json([
               'status'    => 'success',
               'message'   => 'Đã xác nhận đơn hàng thành công.',
            ], 200);
        }
        return response()->json([
           'status'    => 'error',
           'message'   => 'Đã xảy ra lỗi trong quá trình xác nhận đơn hàng.',
        ], 500);
    }

    public function cancel(Request $request) {
        $orderId= $request->input("orderId");
        if($orderId) {
            $order = Order::find($orderId);
            $order->order_status = 'CANCELED';
            $order->save();
            Log::info("cancel " . $order);
            return response()->json([
               'status'    => 'success',
               'message'   => 'Đã hủy đơn hàng thành công.',
            ], 200);
        }
        return response()->json([
           'status'    => 'error',
           'message'   => 'Đã xảy ra lỗi trong quá trình hủy đơn hàng.',
        ], 500);
    }

}
