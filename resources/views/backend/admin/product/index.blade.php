@extends('backend.layouts.app')
@section('title', 'xxx')
@section('head')
<style>
    label {
        white-space: nowrap!important;
        display: inline;
        padding: 0 5px;
        margin: 0;
    }
    label select ,
    label input {
        display: inline!important;
    }
</style>
@endsection
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i> Sản phẩm</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">

    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">

 

            <div class="row">
                <form action=""  class="col-sm-12 d-flex justify-content-between" id="form_filter">



                    <div>
                        <label for="">Tổng số <span id="total_products_txt">{{ $total_products }}</span></label>
                    </div>
                        <div class="col-sm-12_ col-md-6_">
                            <div class="" >
                                <label>hiển thị <select name="per_page" id="per_page_filter"
                                        class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </label>
                            </div>
                        </div>
        
        
                        <div class="" >
                            <label>Phân loại <select name="cate"  class="form-control form-control-sm" id="category_filter">
                                <option value="0"></option>
                            @foreach($categories as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select></label>
                        </div>
        
                        <div class="col-sm-12_ col-md-6_">
                            <div class="search_txt">
                                <label>Search:<input type="text" id="search_txt_filter" name="search_txt"
                                        class="form-control form-control-sm" placeholder="" aria-controls="sampleTable"></label>
                            </div>
                        </div>
         
                        <div class="col-sm-12_ col-md-7_">
                            <div class="dataTables_paginate paging_simple_numbers" id="sampleTable_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="prev_page_li">
                                        <a href="#" aria-controls="sampleTable" data-dt-idx="0" tabindex="0" id="prev_page"
                                            class="page-link">Previous</a>
                                    </li>
                                    <li class="paginate_button page-item active d-flex align-items-center">
                                        <label>
                                            <input 
                                                type="number" 
                                                name="page_number" 
                                                id="page_number_filter"
                                                class="form-control form-control-sm" 
                                                placeholder=""  
                                                value="{{ $filter->page_number }}" 
                                                style="width: 60px"
                                                > / <span id="page_number_max_txt"> {{ $filter->page_number_max }} </span> </label>
                                    </li>
                                    <input type="hidden" id="page_number_max" value="{{ $filter->page_number_max }}">
        
                                    <li class="paginate_button page-item next" id="next_page_li">
                                        <a  id="next_page" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>



                </form>
            </div>







            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Giá bán</th>
                        <th>Giá nhập</th>
                        <th>Khuyễn mãi</th>
                        <th>Đã bán</th>
                        <th>Tồn kho</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data_table">

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
        loadDataTable ();

        function loadDataTable () {
            var formData = $("#form_filter").serialize();
            var action = "{{ route('admin.product.loadDataTable') }}?" + formData;
            console.log(action);
            $.ajax({
                url: action,
                method: 'get',
                success: function(response) {
                    // console.log(response);
                    $('#data_table').html(response.html);
                    $('#page_number_max').val(response.page_number_max);
                    $('#page_number_max_txt').text(response.page_number_max);
                    $('#total_products_txt').text(response.total_products);
                    
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        function setPageNumber(pageNumber) {
            var max_page = $('#page_number_max').val();
            max_page = parseInt(max_page, 10);
            pageNumber = parseInt(pageNumber, 10);
            $('#prev_page_li').removeClass('disabled');
            $('#next_page_li').removeClass('disabled');
            
            
            console.log(max_page, pageNumber);
            console.log(pageNumber > max_page);
            console.log(pageNumber < 1);
            if (isNaN(pageNumber)) {
                pageNumber = 1;  // Giá trị mặc định nếu không phải số
            }
            if(pageNumber > max_page){
                pageNumber = max_page;
                $('#next_page_li').addClass('disabled');
            }
            if(pageNumber <= 1){
                pageNumber = 1;
                $('#prev_page_li').addClass('disabled');
            }
            $('#page_number_filter').val(pageNumber);
            return;
        }

        $('#category_filter').change(function() {
            if($('#page_number_filter').val() != 1) {
                setPageNumber(1);
            }
            loadDataTable();
        });

        $('#per_page_filter').change(function() {
            if($('#page_number_filter').val() != 1) {
                setPageNumber(1);
            }
            loadDataTable();
        });
        $('#search_txt_filter').on('keydown change', function() { 
            if($('#page_number_filter').val() != 1) {
                setPageNumber(1);
            }

            loadDataTable();
        });

        $('#page_number_filter').on('keydown change', function() {
            var new_page = $('#page_number_filter').val();
            // if(new_page > max_page){
            //     $('#page_number_filter').val(max_page);
            // }
            // if(new_page < 1){
            //     $('#page_number_filter').val(1);
            // }
            setPageNumber(new_page);
            loadDataTable();
        });
        $('#next_page').on('click', function(e) {
            e.preventDefault(); 
            console.log('next page clicked');
            var new_page = $('#page_number_filter').val();
            new_page = parseInt(new_page, 10) + 1;
            setPageNumber(new_page);
            loadDataTable();

        });

        $('#prev_page').on('click', function(e) {
            e.preventDefault(); 
            console.log('prev page clicked');
            var new_page = $('#page_number_filter').val();
            new_page = parseInt(new_page, 10) - 1;
            setPageNumber(new_page);
            loadDataTable();

        });

        
 

    });
</script>
@endsection