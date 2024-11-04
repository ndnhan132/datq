<style>
    .modal_photo_img_disable{
    border-radius: 4px; /* Bo tròn góc nếu cần */
    filter: grayscale(100%); /* Làm mờ ảnh */
    opacity: 0.5; /* Giảm độ sáng của ảnh */
    pointer-events: none; /* Không cho phép tương tác với hình ảnh */
    }

    
</style>


<div class="d-flex flex-wrap modal_photo_wrap">
     @foreach ($last30Photos as $photo)
        <div class="p-2">
            <img src="{{ asset( $photo->path ) }}" alt="" srcset="" width="130" data-photoid="{{ $photo->id }}" 
            class="{{ ( isset($product) && $product->photos->contains($photo->id) ) ? 'modal_photo_img_disable' : "modal_photo_img" }}"
            style="background-color: #f0f0f0;"
            >
        </div>
    @endforeach
</div>