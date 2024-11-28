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
        $categories  = Category::orderBy('created_at', 'desc')->where('parent_id', '1')->get();

        $per_page = 10;
        $total_products = Product::count();
        $page_number_max = ceil( $total_products / $per_page);
        $filter = (object) [
            "per_page" => "10",
            "cate" => "0",
            "search_txt" => "",
            "page_number" => "1",
            "page_number_max" => $page_number_max,
        ];
        $products =  Product::orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();
        return view('backend.admin.product.index', compact('products', 'categories', 'filter', 'total_products') );
    }

    public function create() {
        $categories = Category::where('parent_id', 1)->get();
        $formAction = route('admin.product.store');

        return view('backend.admin.product.create', compact('categories', 'formAction') );
    }
    public function store(Request $request) {
        // Log::debug($request->all());
        $validator = Validator::make($request->all(), [
            'name_vi' => 'required|string|max:190|unique:products',
            'name_zh' => 'max:190|unique:products',
            'unit' => 'required|string|max:20',
            'category' => 'required',
            'cost_price' => 'numeric|min:0',
            'price' => 'numeric|min:0',
            'discount' => 'integer|between:0,100',
            'editor_description_vi'  => 'nullable',
            'editor_description_zh'  => 'nullable',
            'kiotviet_id'  => 'nullable',
            'quantity'  =>  'integer',
        ], [
            'name_vi.required' => 'Tên là bắt buộc.',
            'name_vi.string' => 'Tên phải là một chuỗi ký tự.',
            'name_vi.max' => 'Tên không được vượt quá 190 ký tự.',
            'name_vi.unique' => 'Tên đã tồn tại.',

            'name_zh.required' => 'Tên là bắt buộc.',
            'name_zh.string' => 'Tên phải là một chuỗi ký tự.',
            'name_zh.max' => 'Tên không được vượt quá 190 ký tự.',
            'name_zh.unique' => 'Tên đã tồn tại.',

            'unit.required' => 'Đơn vị đo lường là bắt buộc.',
            'unit.string' => 'Đơn vị đo lường phải là chuỗi ký tự.',
            'unit.max' => 'Đơn vị đo lường không được vượt quá 20 ký tự.',
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
        $productDescriprion_vi = $validated['editor_description_vi'] ?? '';
        $productDescriprion_zh = $validated['editor_description_zh'] ?? '';
        $product = new Product();
        $product->name_vi = $validated['name_vi'];
        $product->name_zh = $validated['name_zh'];
        $product->slug = Str::slug( $validated['name_vi'] , '-' );
        $product->unit = $validated['unit'];
        $product->cost_price = $validated['cost_price'];
        $product->price = $validated['price'];
        $product->discount = $validated['discount'];
        $product->description_vi = $productDescriprion_vi;
        $product->description_zh = $productDescriprion_zh;
        $product->kiotviet_id = $validated['kiotviet_id'];
        $product->quantity = $validated['quantity'];

        $product->save();
        $product->categories()->sync($validated['category']);

        $photoArr = $request->input('photo_id') ?? [];
        $product->photos()->sync( $photoArr );
        
        Log::info(session()->get('user')->display_name.' thêm mới sản phẩm: '. $product->name);
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
        Log::debug($request->all());
        $productId = $request->input('product_id') ?? '';
        $validator = Validator::make($request->all(), [
            'name_vi' => [
                'string',
                'max:190',
                Rule::unique('products')->ignore($productId),
            ],
            'name_zh' => [
                'max:190',
                Rule::unique('products')->ignore($productId),
            ],
            'unit' => 'required|string|max:20',
            'category' => 'required',
            'cost_price' => 'numeric|min:0',
            'price' => 'numeric|min:0',
            'discount' => 'integer|between:0,100',
            // 'product_id' => 'required',
            'editor_description_vi'  => 'nullable',
            'editor_description_zh'  => 'nullable',
            'kiotviet_id'  => 'nullable',
            'quantity'  =>  'integer',
        ], [
            'name_vi.required' => 'Tên là bắt buộc.',
            'name_vi.string' => 'Tên phải là một chuỗi ký tự.',
            'name_vi.max' => 'Tên không được vượt quá 190 ký tự.',
            'name_vi.unique' => 'Tên đã tồn tại.',

            'name_zh.required' => 'Tên là bắt buộc.',
            'name_zh.string' => 'Tên phải là một chuỗi ký tự.',
            'name_zh.max' => 'Tên không được vượt quá 190 ký tự.',
            'name_zh.unique' => 'Tên đã tồn tại.',

            'unit.required' => 'Đơn vị đo lường là bắt buộc.',
            'unit.string' => 'Đơn vị đo lường phải là chuỗi ký tự.',
            'unit.max' => 'Đơn vị đo lường không được vượt quá 20 ký tự.',
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



        $productDescriprion_vi = $validated['editor_description_vi'] ?? '';
        $productDescriprion_zh = $validated['editor_description_zh'] ?? '';
        $product = Product::find($productId);
        $product->name_vi = $validated['name_vi'];
        $product->name_zh = $validated['name_zh'];
        // $product->slug = Str::slug( $validated['name_vi'] , '-' );
        $product->unit = $validated['unit'];
        $product->cost_price = $validated['cost_price'];
        $product->price = $validated['price'];
        $product->discount = $validated['discount'];

        $product->description_vi = $productDescriprion_vi;
        $product->description_zh = $productDescriprion_zh;
        $product->kiotviet_id = $validated['kiotviet_id'];
        $product->quantity = $validated['quantity'];


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


    public function loadDataTable( Request $request) {
        Log::debug("loading data table". json_encode($request->all()));
        $per_page = $request->input('per_page') ?? 10;
        $cate = $request->input('cate') ?? 0;
        $search_txt = $request->input('search_txt') ?? null;
        $page_number = $request->input('page_number') ?? 1;

        $query = Product::query();

        if ($cate) {
            $query->whereHas('categories', function ($q) use ($cate) {
                $q->where('categories.id', $cate); // Lọc theo `category_id`
            });
        }
        if ( !empty($search_txt) ) {
            $query->where('name_vi', 'like' , "%" .$search_txt . "%");
        }

        // Tính số lượng sản phẩm trong query
$total_products = $query->count(); // Tổng số sản phẩm

// Tính số trang tối đa
$page_number_max = ceil($total_products / $per_page);


        if($per_page ) {
            $query->take($per_page);
        }

        if($page_number) {
            $offset = ($page_number - 1) * $per_page; // Tính vị trí bắt đầu
            $query->skip($offset); // Bỏ qua số bản ghi tương ứng
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $html =  view( 'backend.admin.product.datatable', compact('products') )->render();
        return response()->json([
            'html' => $html,
            'total_products' => $total_products,
            'page_number_max' => $page_number_max,
        ], 200);

    }

}
