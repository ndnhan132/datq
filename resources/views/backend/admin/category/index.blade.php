@extends('backend.layouts.app')
@section('title', 'xxx')
@section('head')
@endsection
@section('content')

<div class="app-title">
    <div>
        <!-- <h1><i class="fa fa-edit"></i> Form Samples</h1>
        <p>Sample forms</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <!-- <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item"><a href="#">Sample Forms</a></li> -->
    </ul>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="tile">
            <form method="POST" action="{{ route('admin.category.store') }}">
                <div class="tile-body">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Tên</label>
                        <input class="form-control @error('category_name') is-invalid @enderror" type="text"
                            name="category_name">
                        <div class="form-control-feedback">
                            @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Danh mục lớn</label>
                        <select class="form-control" id="exampleSelect1" name="parent_category">
                            @foreach ($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hình ảnh</label>
                        <!-- <button class="btn btn-" type="button">
                            Thêm ảnh
                        </button> -->
                    </div>

                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        Thêm mới
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="tile">
            <div class="tile" id="load_category_table">
               
            </div>

        </div>
    </div>
    <div class="clearix"></div>
</div>

 



  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  action="#" method="post" class="form-group" id="edit_category_modal_form">
            @csrf
            <input class="form-control" type="text" name="category_name">
            <input class="form-control" type="hidden" name="category_id">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveButton">Lưu</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('/public/web-admin/js/dashboard.js?s=') . time() }}"></script>
<script>
    jQuery(document).ready(function() {
        loadCategoryTable();
        $('#saveButton').click(function() {
            $.ajax({
                url: "{{ route('admin.category.update') }}",
                method: 'POST',
                data: $('#edit_category_modal_form').serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        console.log('Update thành công!');
                        $.notify({
                        title: "",
                        message: "Cập nhật thành công!",
                        icon: 'fa fa-check' 
                    },{
                        type: "info"
                    });
                        loadCategoryTable();
                    } else {
                        console.log('Update thất bại!');
                    }
                }
            });
            $('#editCategoryModal').modal('hide');
        });
        
        $('#editCategoryModal').on('hidden.bs.modal', function () {
            console.log('Modal đã ẩn');
            $('#edit_category_modal_form input[name="category_name"]').val('');
            $('#edit_category_modal_form input[name="category_id"]').val('');
        });
        function loadCategoryTable() {
            if($('#load_category_table')){
                $('#load_category_table').load("{{ route('admin.category.loadCategoryTable') }}");
            }
        }



        








    });
</script>
@endsection



