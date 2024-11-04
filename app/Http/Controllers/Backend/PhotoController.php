<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;


class PhotoController extends Controller
{
    
    public function index() {


    }

    public function ajaxUploadFromProduct(Request $request) {
        Log::debug($request->all());
        if ($request->hasFile('croppedImage')) {
            $image = $request->file('croppedImage');

            // Đặt tên file duy nhất cho ảnh
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Lưu ảnh vào thư mục public/uploads
            $filePath = 'uploads/' . $filename;
            $image->move(public_path('uploads'), $filename);


            $fullUrl =asset( '/public/'. $filePath );
            Log::debug( $fullUrl );


            $photo = new Photo();
            $photo->path = '/public/'. $filePath ;
            $photo->save();

            Log::debug($photo);
            Log::info( session()->get('user')->username . ' upload ảnh ' .$fullUrl );


            // $photo = Photo::find(4);

            return response()->json([
                'success' => true,
                'message' => 'Ảnh đã được lưu thành công!',
                'photo'    => $photo,
                // 'path' => $fullUrl, 
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không có ảnh để lưu!',
        ], 400);
    }


    public function loadProductModalPhoto(Request $request) {
        Log::debug($request->all());
        
        $last30Photos = Photo::latest()->take(30)->get();
        
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        
        // $productPhotoImage = $
        return view('backend.admin.product.modal-photo', compact('last30Photos' , 'product' ));
    }


}
