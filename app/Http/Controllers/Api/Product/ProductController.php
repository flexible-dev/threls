<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductList(Request $req) {
        $productList = Product::query()
            ->select("*")
            ->when(request('keyword'), function($searchQuery) use ($req) {
                $searchQuery->whereRaw('LOWER(name) like ?', "%".$req->keyword."%");
            })
            ->when(request('brand'), function($filterQuery) use ($req) {
                $filterQuery->whereRaw('LOWER(brand) like ?', $req->brand);
            })
            ->paginate($req->per_page, 50);

        return response()->json([
            "success" => true,
            "data" => $productList,
            "message" => "Product List"
        ]);
    }
}
