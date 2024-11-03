<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index() {
        $parentCategories = Category::where('parent_id', 0)->get();
        return view( 'backend.admin.category.index', compact('parentCategories') );
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,name',
        ], [
            'category_name.required' => 'Thông tin bắt buộc.',
            'category_name.string' => 'Tên danh mục không hợp lệ.',
            'category_name.max' => 'Tên danh mục quá dài',
            'category_name.unique' => 'Đã tồn tại.',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $parent_id = $request->input('parent_category') ?? 0;
        $category = new Category();
        $category->name = $validated['category_name'];
        $category->slug = Str::slug( $validated['category_name'] , '-' );
        $category->parent_id = $request->input('parent_category') ?? 0;
        $category->save();

        Log::info(session()->get('user')->username.' thêm mới danh mục: '. $category->name);
 
        return redirect()->route('admin.category.index')->with('success', 'Thêm mới danh mục thành công!');;
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,name',
            'category_id'   => 'required|integer',
        ], [
            'category_name.required' => 'Thông tin bắt buộc.',
            'category_name.string' => 'Tên danh mục không hợp lệ.',
            'category_name.max' => 'Tên danh mục quá dài',
            'category_name.unique' => 'Đã tồn tại.',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }


        $validated = $validator->validated();
        Log::debug($validated); 

        $categoryId = $validated['category_id'];
        $category = Category::find($categoryId);
        $category->name = $validated['category_name'];
        $category->save();
        Log::info(session()->get('user')->username.' cập nhật danh mục: '. 
        $category->name);

        return response()->json([
            'status' => 'success',
            'message' => 'Category update successfully!',
        ], 201);
    }

    public function loadCategoryTable(Request $request) {
        $parentCategories = Category::where('parent_id', 0)->get();
        return view( 'backend.admin.category.category-table', compact('parentCategories') );
    }

    function delete(Request $request) {
        $categoryId = $request->input('catid');
        $category = Category::find($categoryId);
        $category->delete();
        Log::info(session()->get('user')->username.' xóa danh mục: '. 
        $category->name);

        return response()->json([
           'status' =>'success',
           'message' => 'Category deleted successfully!',
        ], 200);
    }


}
