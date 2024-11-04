<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    //

    public function index() {
        $products =  Product::orderBy('created_at', 'desc')->get();

        return view('backend.admin.product.index', compact('products') );
    }

    public function create() {
        $categories = Category::where('parent_id', 1)->get();
        $formAction = route('admin.product.store');

        return view('backend.admin.product.create', compact('categories', 'formAction') );
    }
    public function store(Request $request) {
        // Log::debug($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:190|unique:products',
            'unit_of_measurement' => 'required|string|max:20',
            'category' => 'required',
            'cost_price' => 'numeric|min:0',
            'price' => 'numeric|min:0',
            'discount' => 'integer|between:0,100',
            'editor_description'  => 'nullable',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 190 ký tự.',
            'name.unique' => 'Tên đã tồn tại.',

            'unit_of_measurement.required' => 'Đơn vị đo lường là bắt buộc.',
            'unit_of_measurement.string' => 'Đơn vị đo lường phải là chuỗi ký tự.',
            'unit_of_measurement.max' => 'Đơn vị đo lường không được vượt quá 20 ký tự.',
            'category.required' => 'Danh mục là bắt buộc.',
            'category.integer' => 'Danh mục phải là một số nguyên.',
            'category.exists' => 'Danh mục đã chọn không tồn tại.',
            'cost_price.numeric' => 'Giá gốc phải là một số.',
            'cost_price.min' => 'Giá gốc không được nhỏ hơn 0.',
            'price.numeric' => 'Giá bán phải là một số.',
            'price.min' => 'Giá bán không được nhỏ hơn 0.',
            'discount.integer' => 'Giảm giá phải là một số nguyên.',
            'discount.between' => 'Giảm giá phải nằm trong khoảng từ 0 đến 100.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }
        $validated = $validator->validated();
        $productDescriprion = $validated['editor_description'] ?? '';
        $product = new Product();
        $product->name = $validated['name'];
        $product->slug = Str::slug( $validated['name'] , '-' );
        $product->unit_of_measurement = $validated['unit_of_measurement'];
        $product->cost_price = $validated['cost_price'];
        $product->price = $validated['price'];
        $product->discount = $validated['discount'];
        $product->description = $productDescriprion;

        $product->save();
        $product->categories()->sync($validated['category']);

        $photoArr = $request->input('photo_id') ?? [];
        $product->photos()->sync( $photoArr );
        
        Log::info(session()->get('user')->username.' thêm mới sản phẩm: '. $product->name);
        // Log::debug($product);

        return response()->json([
           'success' => true,
           'message' => 'Thêm mới sản phẩm thành công.',
            'product' => $product ,
            'refferer' => route('admin.product.getUpdate', ['product_id' => $product->id ] ),
        ], 200);

    }


    public function getUpdate( Request $request, $productId ) {
        $categories = Category::where('parent_id', 1)->get();
        $formAction = route('admin.product.postUpdate');
        $product = Product::find( $productId );

        return view('backend.admin.product.create', compact('categories', 'formAction', 'product' ) );
    }
    
    public function postUpdate(Request $request) {
        // Log::debug($request->all());
        $productId = $request->input('product_id') ?? '';
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:190',
                Rule::unique('products')->ignore($productId),
            ],
            'unit_of_measurement' => 'required|string|max:20',
            'category' => 'required',
            'cost_price' => 'numeric|min:0',
            'price' => 'numeric|min:0',
            'discount' => 'integer|between:0,100',
            'product_id' => 'required',
            'editor_description'  => 'nullable',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 190 ký tự.',
            'name.unique' => 'Tên đã tồn tại.',

            'unit_of_measurement.required' => 'Đơn vị đo lường là bắt buộc.',
            'unit_of_measurement.string' => 'Đơn vị đo lường phải là chuỗi ký tự.',
            'unit_of_measurement.max' => 'Đơn vị đo lường không được vượt quá 20 ký tự.',
            'category.required' => 'Danh mục là bắt buộc.',
            'category.integer' => 'Danh mục phải là một số nguyên.',
            'category.exists' => 'Danh mục đã chọn không tồn tại.',
            'cost_price.numeric' => 'Giá gốc phải là một số.',
            'cost_price.min' => 'Giá gốc không được nhỏ hơn 0.',
            'price.numeric' => 'Giá bán phải là một số.',
            'price.min' => 'Giá bán không được nhỏ hơn 0.',
            'discount.integer' => 'Giảm giá phải là một số nguyên.',
            'discount.between' => 'Giảm giá phải nằm trong khoảng từ 0 đến 100.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }
        $validated = $validator->validated();



        $productDescriprion = $validated['editor_description'] ?? '';

        $product = Product::find($productId);
        $product->name = $validated['name'];
        $product->slug = Str::slug( $validated['name'] , '-' );
        $product->unit_of_measurement = $validated['unit_of_measurement'];
        $product->cost_price = $validated['cost_price'];
        $product->price = $validated['price'];
        $product->discount = $validated['discount'];
        $product->description = $productDescriprion;
        $product->save();
        $product->categories()->sync($validated['category']);

        $photoArr = $request->input('photo_id') ?? [];
        $product->photos()->sync( $photoArr );
        
        Log::info(session()->get('user')->username.' chỉnh sửa sản phẩm: '. $product->name);
        // Log::debug($product);

        return response()->json([
           'success' => true,
           'message' => 'Chỉnh sửa sản phẩm thành công.',
            'product' => $product ,
            'refferer' => route('admin.product.getUpdate', ['product_id' => $product->id ] ),
        ], 200);
    }

    public function delete( Request $request ) {
        $productId = $request->input('product_id') ?? '';
        $product = Product::find($productId);
        $product->categories()->detach();
        $product->delete();
        Log::info(session()->get('user')->username.' xóa Sp : '. 
        $product->name);
        return response()->json([
            'success' =>'success',
            'message' => 'Category deleted successfully!',
            'referer' => route('admin.product.index'),
         ], 200);


    }

}
