
jQuery(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $.ajax({
    //     url: '/ajax/hosts/live-search',
    //     type: 'POST',
    //     dataType: 'json',
    //     data: { text: txt },
    // })
    // .done(function (data) {

    // })
    // .fail(function (jqXHR, textStatus, errorThrown) {
    //     console.log(errorThrown);
    // });

    loadHeaderCart();

    $('.add_to_cart').on('click', addToCart );
    $('.qty_update').on('click', cartQtyUpdate );
    $('.btn_cart_order').on('click', cart_order );


    function addToCart (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).data('url'),
            type: 'GET',
        })
        .done(function (data) {
            if(data.status == "success") {
                $('#cart_count').text(data.cartCount);
                loadHeaderCart();
            }
            else {
                
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        });
    }
    function loadHeaderCart () {
        if($('#header_cart_detail')){
            $('#header_cart_detail').load("/cart/header-cart-reload");
        }
    }
    function loadShowDetailCart () {
        if($('#cart_detail_content')){
            $('#cart_detail_content').load("/cart/show-detail-cart-content");
        }
    }
    function cart_order () {
        if($('#cart_detail_content')){
            $('#cart_detail_content').load("/cart/show-cart-order");
        }
    }

    function cartQtyUpdate (e) {
        e.preventDefault();
        var qtyCountEle =  '.qtycount' + $(this).data('prd');
        var qtycount = $(qtyCountEle).text();
        qtycount = Number(qtycount);
        switch ($(this).data('action')) {
            case 'minus':
                qtycount--;
                break;
            case 'plus':
                qtycount++;
                break;
            case 'remove':
                qtycount = 0;
                break;
        }
        if ( qtycount < 1 ) { 
            qtycount = 0;
            $('.cartitem' + $(this).data('prd')).remove();
        }
        $( qtyCountEle ).text( qtycount );
        
        $.ajax({
            url: '/cart/update-cart',
            type: 'POST',
            dataType: 'json',
            // data: { prd: $(this).data('prd'), qty: qtycount },
            data: { prd: $(this).data('prd'), qty: qtycount },
        })
        .done(function (data) {
            if(data.status == "success") {
                $('#cart_count').text(data.cartCount);
                loadHeaderCart();
            }
            else {
                
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        });
    }










});