<div class="d-flex flex-column">
    <div class="d-flex justify-content-between p-2">
        <span>Tạm tính giỏ hàng:</span>
        <span>
            <span id="total_amount_after_discount_text_tmp">{{ convertMoneyToStr( $totalAmountAfterDiscount ) }}</span>
            <span class="vnd">đ</span>
        </span>
    </div>
    <div class="d-flex justify-content-between p-2">
        <span>Phí vận chuyển: </span>
        <span>
            <span id="shipping_fee">{{ $shippingFee }}</span>
            <span class="vnd">đ</span>
        </span> 
    </div>
    <div class="d-flex justify-content-between p-2 border-top">
        <span>Thành tiền:</span>
        <span class="purchase-total" >
            <span id="total_payable_text">{{ convertMoneyToStr( $totalAmountAfterDiscount ) }}</span>
            <span class="vnd">đ</span>
        </span>
    </div>
</div>