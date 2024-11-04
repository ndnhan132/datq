@extends('backend.layouts.app')
@section('title', 'xxx')
@section('head')
@endsection
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i>Sảm phẩm</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">

    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Giá bán</th>
                        <th>Giá nhập</th>
                        <th>Khuyễn mãi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $products as $product )
                    <tr>
                        <td>
                            @if ( $product->photos()->count() )
                                <img src="{{ $product->photos()->first()->path }}" alt="" width="70px">
                            @else
                            <span class="text-danger">Chưa có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @foreach( $product->categories as $category )
                            {{ $category->name }}</br>
                            @endforeach
                        </td>
                        <td>{{ convertMoneyToStr($product->price) }}đ/{{ $product->unit_of_measurement }}</td>
                        <td>{{ convertMoneyToStr($product->cost_price) }} đ</td>
                        <td>{{ $product->discount }}%</td>
                        <td>
                            <a href="{{ route('admin.product.getUpdate', ['product_id' => $product->id ]) }}" class="btn btn-sm btn-light">
                                sửa
                            </a>

                            <a data-action="{{ route('admin.product.delete') }}" data-prdname="{{ $product->name }}" data-prdid="{{ $product->id }}"  class="btn btn-sm btn-light btn_del_product mx-3">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearix"></div>
</div>

@endsection
@section('javascript')
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
                // Người dùng chọn "Hủy"
                // swal("Hủy bỏ!", "Mục không được xóa.", "info");
                swal.close()
                }
            });
        });
    });
</script>
@endsection