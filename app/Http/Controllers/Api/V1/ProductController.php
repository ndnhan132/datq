<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
 
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        if (!$products) {
            return response()->json(['message' => 'No Product found'], 404);
        }
        
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filter(Request $request) {
        $cateId = $request->input('cateId');
        $dataSize = $request->input('dataSize', 10);
        $offset = $request->input('offset', 0);

        $query = Product::query();

        if ($cateId) {
            $query->whereHas('categories', function ($query) use ($cateId) {
                $query->where('categories.id', $cateId);
            });
        }
        if ($offset) {
            $query->skip($offset);
        }
        if ($dataSize) {
            $query->take($dataSize);
        }

        $products = $query->get();

        $product = processProducts($products);
        // Log::info($products);

        return response()->json($products, 200);
    }

    public function flashSale(Request $request) {
        $products = Product::take(24)->get();



        foreach ($products as $product) {
            $product->remainingQuantity = $product->quantity;
        }
        $products = processProducts($products);
        return response()->json($products, 200);

    }
    public function hotDeal(Request $request) {
        $products = Product::offset(30)->take(24)->get();

        
        $products = processProducts($products);
        return response()->json($products, 200);
    }

    public function productsByCategory(Request $request) {
        // Log::info($request);

        $categorySlug = $request->input('categorySlug');
        $perPage = $request->input('perPage', 20); // Default: 10 sản phẩm mỗi trang
        $offset = $request->input('offset', 0); // Offset bắt đầu từ đâu
        $page = $request->input('page', 1); // Trang hiện tại
        $sortBy = $request->input('sortBy', ); // Trang hiện tại

        $category = Category::where('slug', $categorySlug)->first(); 
        $query = Product::query();
        if ($page) {
            $offset = ($page - 1) * $perPage;
        }

        if ($categorySlug) {
            $query->whereHas('categories', function ($query) use ($categorySlug) {
                $query->where('categories.slug', $categorySlug);
            });
        }



        $totalItems = $query->count();
        
        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
                # code...
                break;
            case 'best_selling':
                # code...
                break;
            case 'discount_desc':
                $query->orderBy('discount', 'desc');
                break;
            case 'price_desc':
                $query->orderByRaw('(price - (price * discount / 100)) desc');
                break;
            case 'price_asc':
                $query->orderByRaw('(price - (price * discount / 100)) asc');
                break;
            default:
                # code...
                break;
        }

        if ($offset) {
            $query->skip($offset);
        }
        if ($perPage) {
            $query->take($perPage);
        }
 
        $products = $query->get();


        
        $products = processProducts($products);
        // Log::info($products);

        
        return response()->json([
            'products' =>  $products, // Sản phẩm trong trang hiện tại
            'totalItems' => $totalItems,       // Tổng số sản phẩm
            'categoryName' => $category->name
        ], 200);

        // return response()->json($products, 200);
    }

    function productBySlug(Request $request, $productSlug ) {
        Log::debug("productBySlug ");
        Log::debug( $request->all());
        Log::debug( $productSlug );
        $product = Product::with('photos')->where('slug', $productSlug)->first();
        // dd($request);
        $category  = Category::where('slug', $request->input('categorySlug'))->first();
        if (!$product) {
            return response()->json([
                'product' => [], 
                'message' => 'No Product found'
            ], 404);
        }

        $product = processProduct($product);
        $product->remainingQuantity = $product->quantity;
        $product->categoryName = $category->name;

        return response()->json($product, 200);
    }

    function similar(Request $request ) {
 
        $product = Product::where('slug', $request->input('productSlug'))->first();
        if (!$product) {
            return response()->json([
               'similarProducts' => [], 
               'message' => 'No Product found'
            ], 404);
        }

        $similarProducts = Product::where('id', '!=', $product->id)
        ->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->inRandomOrder()
        ->take(6)
        ->get();

        $similarProducts = processProducts($similarProducts);

        return response()->json( $similarProducts , 200);
    }


    function sanPhamMuaCung(Request $request ) {
 
        $product = Product::where('slug', $request->input('productSlug'))->first();
        if (!$product) {
            return response()->json([
               'similarProducts' => [], 
               'message' => 'No Product found'
            ], 404);
        }

        $similarProducts = Product::where('id', '!=', $product->id)
        ->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->inRandomOrder()
        ->take(6)
        ->get();

        $similarProducts = processProducts($similarProducts);

        return response()->json( $similarProducts , 200);
    }

    public function search(Request $request) {
        $searchQuery = $request->input('searchQuery', "");
        // Log::debug("search query " . $searchQuery);
        $products = Product::query()
        ->where('name_vi', 'like', '%' . $searchQuery . '%')
        ->orWhere('description_vi', 'like', '%' . $searchQuery . '%')
        ->orderBy("sold_quantity", "desc")
        ->take(10)
        ->get();
        $products = processProducts($products);

        return response()->json($products, 200);
    }

    public function suggestSearch(Request $request) {
        $keyWord = [
            "Chân gà", 
            "Bánh Socola",
            "Bánh trứng",
            "Trái Ô liu cam thảo",
            "Ô MAI",
            "BÁNH TAM GIÁC",
            "KẸO QUE PHÔ MAI SỮA BÒ",
            "Mỳ trộn tương đen",
        ];
        $products = Product::take(10)->get();
        $products = processProducts($products);
        
        return response()->json([
            'products' => $products,
           'suggestedKeywords' => $keyWord,
        ], 200);
    }

}
