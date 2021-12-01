<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function searchProduct(Request $req)
    {
        // dd($req->get("query"));
        $products = Products::where('name', 'like', '%' . $req->get("query") . '%')->get()->take(5);

        foreach ($products as $product) {
            if ($product->discount > 0)
                $product['total'] = $product->price - $product->price * ($product->discount / 100);
            else $product['total'] = $product->price;

            $product['sub_total'] = number_format($product->price);

            $product['format_total'] = number_format($product->total);

            if (Auth::guest()) {
                $explode_total = explode(",", $product->format_total);

                $format_x = "";

                $format_x .= $explode_total[0];

                for ($i = 1; $i < count($explode_total); $i++) {
                    $format_x .= "," . "xxx";
                }
                $product["format_total"] = $format_x;
            }


            $product->Categories;
            $product->Brands;
        }

        return response()->json(["data" => compact('products')]);
    }
}
