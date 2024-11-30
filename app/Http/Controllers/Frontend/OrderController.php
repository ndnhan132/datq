<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //
    public function storeOrder(Request $request) {
        $validator = Validator::make($request->all(), [
                'recipient_name' => 'required|string|max:255',
                'recipient_phone' => 'required|string|max:20',
                'recipient_address' => 'required|string',
                'order_note' => 'nullable|string',
            ], [
                'recipient_name.required' => 'Thông tin bắt buộc.',
                'recipient_name.string' => 'Tên người nhận không hợp lệ.',
                'recipient_name.max' => 'Tên người nhận không được vượt quá 255 ký tự.',
                
                'recipient_phone.required' => 'Thông tin bắt buộc.',
                'recipient_phone.string' => 'Số điện thoại không hợp lệ.',
                'recipient_phone.max' => 'Số điện thoại không hợp lệ.',
                
                'recipient_address.required' => 'Thông tin bắt buộc.',
                'recipient_address.string' => 'Địa chỉ người nhận phải là chuỗi ký tự.',
                
                'order_note.string' => 'Ghi chú phải là chuỗi ký tự.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 200);
            }
            $validated = $validator->validated();

            $carts = session()->get('carts', []);
            $cartIds = array_keys($carts);
            $cartProducts = Product::whereIn('id', $cartIds)->get();

            $subTotal = calSubtotal ( $cartProducts, $carts );
            $discountTotal = calDiscountTotal ( $cartProducts, $carts );
            $tax = 0;
            $shippingFee = 0;
            $totalPayable = $subTotal - $discountTotal - $tax - $shippingFee;
            
            $paymentMethod = "COD";


            $order = Order::create([
                'order_id'  => generateOrderId(),
                'sub_total' => $subTotal,
                'discount_total' => $discountTotal,
                'tax' => $tax,
                'shipping_fee' => $shippingFee,
                'total_payable' => $totalPayable,

                'recipient_name' => $validated['recipient_name'],
                'recipient_phone' => $validated['recipient_phone'],
                'recipient_address' => $validated['recipient_address'],
                'order_status' => 'PENDING',
                'payment_method' => $paymentMethod,
                'order_note' => $validated['order_note'] ?? null,
            ]);

 
            foreach ($cartProducts as $cartPrd) {
                // $order->products()->attach( $cartPrd->id, [
                //     'quantity' => $carts[$cartPrd->id]['quantity'],
                //     'cost_price' => $cartPrd->cost_price,
                //     'final_price' => priceAfterDiscount( $cartPrd->price , $cartPrd->discount_percent ),
                // ]);
            }


            session()->forget('carts');

            Log::notice("storeOrder 1" . $order);
            // Log::notice("storeOrder 2" . json_encode($order->toArray()));
            // Log::notice("storeOrder 4" . json_encode( $order) );
            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully!',
                // 'order' => $order,
                'refferer' => route('order.orderComplete', ['order_id' => $order->order_id]),
            ], 201);
    }

    public function orderComplete(Request $request, $orderId) {
        $order = Order::where('order_id', $orderId)->first();

        return view('frontend.order.order-complete', ['orderId' => $orderId]);
    }

}

 