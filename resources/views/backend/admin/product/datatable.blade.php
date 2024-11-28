@foreach( $products as $product )
<tr>
    <td>
        @if ( $product->photos()->count() )
            <img src="{{ asset( $product->photos()->first()->path ) }}" alt="" width="70px">
        @else
        <span class="text-danger">Chưa có ảnh</span>
        @endif
    </td>
    <td>
        <span>Việt: </span><span>{{ $product->name_vi }}</span><br/>
        <span>Trung: </span><span>{{ $product->name_zh }}</span>
    </td>
    <td>
        @foreach( $product->categories as $category )
        {{ $category->name }}</br>
        @endforeach
    </td>
    <td>{{ convertMoneyToStr($product->price) }}đ/{{ $product->unit }}</td>
    <td>{{ convertMoneyToStr($product->cost_price) }} đ</td>
    <td>{{ $product->discount }}%</td>
    <td>{{ $product->sold_quantity }}</td>
    <td>{{ $product->quantity }}</td>
    <td>
        <a href="{{ route('admin.product.getUpdate', ['product_id' => $product->id ]) }}" class="btn btn-sm btn-light">
            sửa
        </a>

        <a data-action="{{ route('admin.product.delete') }}" data-prdname="{{ $product->name_vi }}" data-prdid="{{ $product->id }}"  class="btn btn-sm btn-light btn_del_product mx-3">
            Xóa
        </a>
    </td>
</tr>
@endforeach


<script>
    jQuery(document).ready(function () {

        $('.btn_del_product').click(function () {
            var action = $(this).data('action');
            var prdid = $(this).data('prdid');
            swal({
                title: "",
                text: "Xóa " + $(this).data('prdname'),
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa!",
                cancelButtonText: "Hủy",
                closeOnConfirm: false,
                closeOnCancel: false,
                buttons: {
                    cancel: {
                        text: "Hủy",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true // Đóng bảng thông báo khi chọn Hủy
                    },
                }
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: action,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id : prdid,
                        },
                        success: function(response) {
                            if ( response.success ){
                                swal("Đã xóa!", "Mục đã được xóa thành công.", "success");
                                // console.log(response);
                                window.location.href =  response.referer;
                            }
                            else{
                                swal("Lỗi!", "Đã có lỗi xảy ra trong quá trình xóa.");
                            }
                        },
                        error: function(xhr, status, error) {
                            swal("Lỗi!", "Đã có lỗi xảy ra trong quá trình xóa.", "error");
                        }
                    });
                }
                else {
                swal.close()
                }
            });
        });
    });
</script>