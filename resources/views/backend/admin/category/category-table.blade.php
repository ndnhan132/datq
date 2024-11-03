<table class="table" id="load_category_table">
    <thead>
        <tr>
            <th>Danh mục lớn</th>
            <th>Danh mục con</th>
            <th>Số sản phẩm</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($parentCategories as $parentCat)
        @php
        $firstChildCat = $parentCat->children->first();
        @endphp

        @if ($firstChildCat)
        <tr>
            <td rowspan="{{ $parentCat->children()->count() }}">{{ $parentCat->name }}</td>
            <td class="category_edit" data-catname="{{ $firstChildCat->name }}" data-catid="{{ $firstChildCat->id }}"
                data-toggle="modal" data-target="#editCategoryModal">{{ $firstChildCat->name }}</td>
            <td>{{ $firstChildCat->products()->count() }}</td>
            <td>
                <div class="btn btn_delete_cat" data-catname="{{ $firstChildCat->name }}" data-catid="{{ $firstChildCat->id }}">
                    Xóa</div>
            </td>
        </tr>
        @endif
        @foreach($parentCat->children as $childCat)
        @if ($childCat !== $firstChildCat)
        <tr>
            <td class="category_edit" data-catname="{{ $childCat->name }}" data-catid="{{ $childCat->id }}"
                data-toggle="modal" data-target="#editCategoryModal">{{ $childCat->name }}</td>
            <td>{{ $childCat->products()->count() }}</td>
            <td>
                <div class="btn btn_delete_cat" data-catname="{{ $childCat->name }}" data-catid="{{ $childCat->id }}">
                    Xóa</div>
            </td>
        </tr>
        @endif
        @endforeach
        @endforeach
    </tbody>
</table>







<script>
    jQuery(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.category_edit').click(function () {
            $('#edit_category_modal_form input[name="category_name"]').val($(this).data('catname'));
            $('#edit_category_modal_form input[name="category_id"]').val($(this).data('catid'));
        });






        $('.btn_delete_cat').click(function () {
            var catId = $(this).data('catid');
            swal({
                title: "",
                text: "Xóa " + $(this).data('catname'),
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa!",
                cancelButtonText: "Hủy",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: "{{ route('admin.category.delete') }}",
                        method: 'POST',
                        data: { catid: catId },
                        success: function (response) {
                            if (response.status == 'success') {
                                loadCategoryTable();
                                swal("Deleted!", "Xóa thành công.", "success");
                            }
                            else {
                                swal("Cancelled", "Xóa thất bại)", "error");
                            }
                        }
                    });

                }
            });
        });
        function loadCategoryTable() {
            if($('#load_category_table')){
                $('#load_category_table').load("{{ route('admin.category.loadCategoryTable') }}");
            }
        }




    });
</script>