@extends('backend.layouts.app')
@section('title', 'Thêm mới sản phẩm')
@section('head')
 
<link rel="stylesheet" type="text/css" href="{{asset('/public/plugins/cropper/cropper.css')}}">

<script type="text/javascript" src="{{asset('/public/plugins/cropper/cropper.min.js')}}"></script>
<!-- <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> -->
<script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
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
            <div class="tile-footer  text-right">
                <button class="btn btn-primary" type="button" id="product_create_form_submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>
                    @if(isset($product))
                    Cập nhật
                    @else
                    Thêm mới
                    @endif
                </button>
            </div>

            <div class="tile-body">
                <form class="d-flex flex-wrap" method="POST" id="product_create_form" action="{{ $formAction }}">
                    @csrf
                    @if (isset($product))
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @endif
                    <div class="col-sm-6">
                        <div class="form-group col-sm-12">
                            <label class="control-label">Tên sp Việt</label>
                            <input class="form-control" type="text" placeholder="tên sp" name="name_vi" value="{{ isset($product) ? $product->name_vi : '' }}" >
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="name_vi_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="control-label">Tên sp trung</label>
                            <input class="form-control" type="text" placeholder="tên sp" name="name_zh" value="{{ isset($product) ? $product->name_zh : '' }}" >
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="name_zh_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Đơn vị tính</label>
                            <input class="form-control" type="text" placeholder="Đơn vị tính" name="unit" value="{{ isset($product) ? $product->unit : '' }}"   >
                                <div class="form-control-feedback">
                                    <span class="text-danger form-text-errorr" id="unit_err"></span>
                                </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label class="control-label">Danh mục</label>
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="category_err"></span>
                            </div>
                            <div class="form-check d-flex flex-column">
                                @foreach( $categories as $category )
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="category[]" {{ ( isset($product) && $product->categories->contains($category->id) ) ? 'checked' : '' }} value="{{ $category->id }}">{{ $category->name }}
                                </label>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group col-sm-6">
                            <label class="control-label">kiotviet id</label>
                            <input class="form-control" type="text" placeholder="kiotviet id" name="kiotviet_id" value="{{ isset($product) ? $product->kiotviet_id : '0' }}">
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="kiotviet_id_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Giá nhập</label>
                            <input class="form-control" type="number" placeholder="Giá nhập" name="cost_price" value="{{ isset($product) ? $product->cost_price : '0' }}">
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="cost_price_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Giá bán</label>
                            <input class="form-control" type="number" placeholder="Giá bán" name="price" value="{{ isset($product) ? $product->price : '' }}">
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="price_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">

                            <label class="control-label">Khuyến mãi %</label>
                            <input class="form-control" type="number" placeholder="Khuyến mãi" name="discount" value="{{ isset($product) ? $product->discount : '0' }}">
                            <div class="form-control-feedback">
                                <span class="text-dange form-text-errorr" id="discount_err"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="control-label">Số lượng</label>
                            <input class="form-control" type="number" placeholder="Số lượng" name="quantity" value="{{ isset($product) ? $product->quantity : '0' }}">
                            <div class="form-control-feedback">
                                <span class="text-danger form-text-errorr" id="quantity_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" id="upload_image">Thêm ảnh</button>

                        <div class="d-flex flex-wrap" id="product_photo_preview">
                            
                            @if( isset($product) )
                            @foreach($product->photos as $photo)
                            <div style="width: 120px;" class="p-1">
                                <img src="{{ asset( $photo->path ) }}" alt="" class="w-100 pb-1">
                                <input type="hidden" value="{{ $photo->id }}" name="photo_id[]">
                                <button  class="btn  btn-warning btn-sm w-100 btn_remove_img">xóa</button>
                            </div>

                            @endforeach
                            @endif



                        </div>
                    </div>



                    <div class="col-sm-12 mt-3">
                        <textarea name="editor_description" id="ck_editor_vi">{{ (isset($product) && isset($product->description_vi)) ? $product->description_vi : "" }}</textarea>
                    </div>

                    <div class="col-sm-12 mt-3">
                        <textarea name="editor_description" id="ck_editor_zh">{{ (isset($product) && isset($product->description_zh)) ? $product->description_zh : "" }}</textarea>
                    </div>















                </form>
            </div>



        </div>
    </div>
    <div class="clearix"></div>
</div>



<div class="modal fade" id="upload_image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
            
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#upload_tab"  aria-controls="upload_tab" role="tab" data-toggle="tab">upload</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#media_tab"  aria-controls="media_tab" role="tab" data-toggle="tab">Ảnh có sẵn</a>
                </li>
              </ul>

              <div class="tab-content " style="min-height: 400px;">
                <div role="tabpanel" class="tab-pane active d-flex flex-column" id="upload_tab">

                    <label for="input_image" class="btn">
                        Chọn ảnh
                        <input class="btn d-none" id="input_image" type="file" accept="image/*" />
                    </label>

                    <div>
                        <img id="display_image" style="max-width: 100%; display: none;max-height: 500px;">
                    </div>
                    <canvas id="canvas" style="display: none;"></canvas>
                
                    <button id="crop_button" class="btn mt-auto">Cắt ảnh và lưu lại</button>
                </div>
                <div role="tabpanel" class="tab-pane" id="media_tab">
      
                </div>

              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">đóng</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('javascript')

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        CKEDITOR.replace('ck_editor_vi');
        CKEDITOR.replace('ck_editor_zh');
        CKEDITOR.config.height = 400;


        
        $('#product_create_form_submit').on('click', function(e) {
            e.preventDefault();
            var actionUrl = $('#product_create_form').attr('action');

            $('.form-text-error').empty();


            let formData = $('#product_create_form').serializeArray();
            const editor_description_vi = CKEDITOR.instances.ck_editor_vi.getData();
            formData.push({ name: 'editor_description_vi', value: editor_description_vi }); // Thêm dữ liệu CKEditor vào array

            const editor_description_zh = CKEDITOR.instances.ck_editor_zh.getData();
            formData.push({ name: 'editor_description_zh', value: editor_description_zh }); // Thêm dữ liệu CKEditor vào array

            let finalFormData = new FormData();
            formData.forEach(item => {
                finalFormData.append(item.name, item.value);
            });



            $.ajax({
                type: 'POST',
                url: actionUrl, 
                data: formData, 
                success: function(response) {
                    console.log(response);
                    if ( response.success ){
                        $.notify({
                            title: "",
                            message: response.message,
                            icon: 'fa fa-check' 
                        },{
                            type: "info"
                        });
                        window.location.href = response.refferer;
                    } else {
                        $.each(response.errors, function(index, value) {
                            $('#'+index+'_err').text(value);
                        });
                    }
                },
                error: function() {
                    $('#response').html('An error occurred. Please try again.');
                }
            });
        });


        var $modal = $('#upload_image_modal');
        $('#upload_image').click(function(event){
            if($('#media_tab')){
                let load_url = "{{ route('admin.photo.loadProductModalPhoto') }}";
                const productIdInput = document.querySelector('input[name="product_id"]');
                if (productIdInput) {
                    load_url += "/?product_id=" + productIdInput.value;
                }


                $('#media_tab').load(load_url);
            }
            
            

                        const uploadTab = document.getElementById('upload_tab');

                        // // Xóa nội dung bên trong #upload_tab
                        uploadTab.innerHTML = '';

                        // Thêm đoạn HTML mới
                        uploadTab.innerHTML = `
                            <label for="input_image" class="btn">
                                Chọn ảnh
                                <input class="btn d-none" id="input_image" type="file" accept="image/*" />
                            </label>
                            <div>
                                <img id="display_image" style="max-width: 100%; display: none; max-height: 500px;">
                            </div>
                            <canvas id="canvas" style="display: none;"></canvas>
                            <button id="crop_button" class="btn mt-auto">Cắt ảnh và lưu lại</button>
                        `;
            
            
            
            
            
            $modal.modal('show');


            
        });

        const productPhotoPreview = document.getElementById('product_photo_preview');
        if (productPhotoPreview) {
            productPhotoPreview.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn_remove_img')) {
                e.preventDefault();
                e.target.closest('div').remove();
            }
            });
        }
 


    const mediaTab = document.getElementById('media_tab');
    if (mediaTab) {
        mediaTab.addEventListener('click', function (e) {
            if (e.target.classList.contains('modal_photo_img')) {

                const photoPath = e.target.getAttribute('src');
                const photoId = e.target.getAttribute('data-photoid');

                const newPhotoHtml = createPhotoHtml(photoPath, photoId);
                document.getElementById('product_photo_preview').insertAdjacentHTML('beforeend', newPhotoHtml);
                $.notify({
                            title: "",
                            message: 'đã thêm ảnh',
                            icon: 'fa fa-check' 
                        },{
                            type: "info"
                        });

                e.target.classList.remove('modal_photo_img');
                e.target.classList.add('modal_photo_img_disable');

            }
        });
    }












    const inputImage = document.getElementById('input_image');

    const cropButton = document.getElementById('crop_button');
    const canvas = document.getElementById('canvas');
    let cropper;

    const uploadTab = document.getElementById('upload_tab');
    uploadTab.addEventListener('change', function(e) {
    
        if (e.target && e.target.id === 'input_image') {

            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const image = document.getElementById('display_image');
                    image.src = event.target.result;
                    image.style.display = 'block';
                    
                    cropper = new Cropper(image, {
                        aspectRatio: 1/1,
                        viewMode: 1,
                    });
                };
                reader.readAsDataURL(files[0]);
            }

            
        }
    });


    // inputImage.addEventListener('change', function(e) {
    //     const files = e.target.files;
    //     const done = url => {
    //         inputImage.value = '';
    //         image.src = url;
    //         image.style.display = 'block';

    //         cropper = new Cropper(image, {
    //             aspectRatio: 2/3,
    //             viewMode: 1,
    //         });
    //     };

    //     if (files && files.length > 0) {
    //         const reader = new FileReader();
    //         reader.onload = () => done(reader.result);
    //         reader.readAsDataURL(files[0]);
    //     }
    // });

    uploadTab.addEventListener('click', function(e) {
        // Kiểm tra nếu sự kiện xảy ra trên cropButton
        if (e.target && e.target.id === 'crop_button') {

            if (cropper) {
                // Lấy dữ liệu ảnh đã cắt từ Cropper
                const croppedCanvas = cropper.getCroppedCanvas({
                    width: 800,
                    height: 800,
                });

                // Hiển thị ảnh đã cắt trên canvas
                const context = canvas.getContext('2d');
                canvas.width = croppedCanvas.width;
                canvas.height = croppedCanvas.height;
                context.drawImage(croppedCanvas, 0, 0);

                croppedCanvas.toBlob(blob => {
                    const file = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const formData = new FormData();
                    formData.append('croppedImage', file);
                    formData.append('_token', csrfToken);

                    fetch("{{ route('admin.photo.ajaxUploadFromProduct') }}", {
                        method: 'POST',
                        body: formData
                    }).then(response => {
                        return response.json();
                    }).then(data => {
                        console.log('Upload success:', data);

                        $.notify({
                            title: "",
                            message: data.message,
                            icon: 'fa fa-check'
                        }, {
                            type: "info"
                        });

                        const newPhotoHtml = createPhotoHtml(data.photo.path, data.photo.id);
                        document.getElementById('product_photo_preview').insertAdjacentHTML('beforeend', newPhotoHtml);
                        $modal.modal('hide');
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi');
                    });
                }, 'image/jpeg');
            }
        }
    });

    // cropButton.addEventListener('click', function () {
    //     if (cropper) {
    //         // Lấy dữ liệu ảnh đã cắt từ Cropper
    //         const croppedCanvas = cropper.getCroppedCanvas({
    //             width: 512,
    //             height: 768,
    //         });

    //         // Hiển thị ảnh đã cắt trên canvas
    //         const context = canvas.getContext('2d');
    //         canvas.width = croppedCanvas.width;
    //         canvas.height = croppedCanvas.height;
    //         context.drawImage(croppedCanvas, 0, 0);

    //         croppedCanvas.toBlob(blob => {
    //             const file = new File([blob], 'cropped_image.jpg', { type: 'image/jpeg' });
    //             const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //             const formData = new FormData();
    //             formData.append('croppedImage', file);
    //             formData.append('_token', csrfToken);

    //             fetch("{{ route('admin.photo.ajaxUploadFromProduct') }}", {
    //                 method: 'POST',
    //                 body: formData
    //             }).then(response => {
    //                 return response.json();
    //             }).then(data => {
    //                 console.log('Upload success:', data);


    //                 $.notify({
    //                     title: "",
    //                     message: data.message,
    //                     icon: 'fa fa-check'
    //                 }, {
    //                     type: "info"
    //                 });

    //                 const newPhotoHtml = createPhotoHtml(data.photo.path, data.photo.id);
    //                 document.getElementById('product_photo_preview').insertAdjacentHTML('beforeend', newPhotoHtml);
    //                 $modal.modal('hide');
    //             }).catch(error => {
    //                 console.error('Error:', error);
    //                 alert('Đã xảy ra lỗi');
    //             });
    //         }, 'image/jpeg');
    //     }
    // });

    







    function createPhotoHtml(photoPath, photoId) {
        return `
            <div style="width: 120px;" class="p-1">
                <img src="${photoPath}" alt="" class="w-100 pb-1">
                <input type="hidden" value="${photoId}" name="photo_id[]">
                <button class="btn btn-warning btn-sm w-100 btn_remove_img">xóa</button>
            </div>
        `;
    }











});

</script>
    

    
    
@endsection