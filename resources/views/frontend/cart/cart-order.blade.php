<form action="{{ route('order.storeOrder') }}" method="post" class="w-100 cart-order-form" id="cart_order_form">
    @csrf
    <div class="white-wrapbox  cart-header ">
        <div class="d-flex">
            <button class="btn_back_cart_detail btn btn-sm btn-transparent"  ><i class="fa-solid fa-chevron-left"></i></button>
            <script>
                jQuery(document).ready(function() {
                    $('.btn_back_cart_detail').on('click', function() {
                        if($('#cart_detail_content')){
                        $('#cart_detail_content').load("/cart/show-detail-cart-content");
                    }
                    } );
                });
            </script>
            <div class="text-center w-100 d-flex align-items-center justify-content-center ">
                <h2>Xác nhận đặt hàng</h2>
            </div>
        </div>
    </div>
    <div class="white-wrapbox">
        <div class="box-head">
            Thông tin nhận hàng
        </div>
        <div class="order-form-row">
            <label for="" class="col-sm-3">Họ tên người nhận<span>*</span></label>
            <input type="text" class="form-control"  placeholder="Nhập họ tên đầy đủ" value="{{ fakeName() }}" name="recipient_name" >
            <div id="recipient_name_error" class="form-text form-text-error"></div>
        </div>
        <div class="order-form-row">
            <label for=""class="col-sm-3">Số điện thoại<span>*</span></label>
            <input type="text"  class="form-control"  placeholder="Sdt liên hệ"  value="{{ fakePhone() }}"  name="recipient_phone" >
            <div id="recipient_phone_error" class="form-text form-text-error"></div>

        </div>
        
        <div class="order-form-row">
            <label for="" class="col-sm-3">Địa chỉ<span>*</span></label>
            <input type="text" class="form-control" placeholder="Số nhà, tên đường"  value="{{ fakeAddress() }}" name="recipient_address" >
            <div id="recipient_address_error" class="form-text form-text-error"></div>

        </div>
    </div>
    <div class="white-wrapbox">
        <div class="box-head">
            Ghi chú giao hàng
        </div>
        <div class="order-form-row" >
            <textarea name="order_note" id="" class="w-100 form-control " rows="5">{{ fakeText() }}</textarea>
        </div>
    </div>
    <div class="white-wrapbox">
        <div class="box-head">
        Phương thức thanh toán
        </div>
        <div class="d-flex flex-column order-form-row payment-method">

            <label class="d-flex align-item-center payment-box">
                <input type="radio" value="cod" name="payment_type" checked >
                <div class="d-flex">
                    <img src="{{ asset('img/cash-on-delivery.png') }}" alt="" class="mx-2">
                    <div class="d-flex align-items-center">
                        Thanh toán khi nhận hàng
                    </div>
                </div>
            </label>

        </div>
    </div>

    <div class="white-wrapbox">
        <div>
            <div class="col-sm-7 ms-auto row-total-amount">
                @include('frontend.cart.row-total-amount')
            </div>
        </div>
    </div>
    <div class="white-wrapbox">
        <div class="cart-policy">
            <small></small>
            <div>Bằng cách nhấn vào "Đặt hàng", bạn xác nhận rằng bạn đồng ý với các <a href="#"> điều khoản và chính sách </a> của chúng tôi.
            </div>
        </div>
        <div class="btn-checkout my-2">
            <button class="btn btn-danger w-100 btn_cart_order fw-bold py-2">Xác nhận đặt hàng</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function(){
    $('#cart_order_form').on('submit', function(e) {
        e.preventDefault();
        var actionUrl = $(this).attr('action');
        $('.form-text-error').empty();
        $.ajax({
            type: 'POST',
            url: actionUrl, 
            data: $(this).serialize(), 
            success: function(response) {
                // console.log(response);
                if(response.status =='success'){
                    window.location.href = response.refferer;
                } else {
                    $.each(response.errors, function(index, value) {
                        $('#'+index+'_error').text(value);
                    });
                }
                
            },
            error: function() {
                $('#response').html('An error occurred. Please try again.');
            }
        });
    });
});
</script>


