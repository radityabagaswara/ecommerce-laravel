<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_raw = Products::all();
        $products = [];

        foreach ($products_raw as $product) {
            $product['brand'] = $product->brands;
            $product['category'] = $product->categories;

            $products[] = $product;
        }
        return view('admin.products.index', compact('products'));
    }

    public function detail($slug)
    {
        $product = Products::where('name', $slug)->first();
        $recomended = Products::all();

        if ($product->discount > 0)
            $product['total'] = $product->price - $product->price * ($product->discount / 100);
        else $product['total'] = $product->price;

        $product['format_total'] = number_format($product->total);

        $explode_total = explode(",", $product->format_total);

        $format_x = "";

        $format_x .= $explode_total[0];

        for ($i = 1; $i < count($explode_total); $i++) {
            $format_x .= "," . "xxx";
        }
        $product["formated_total"] = $format_x;


        $product_category = $product->categories;
        $product_brand = $product->brands;

        return view("products.detail", compact('product', 'product_brand', 'product_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brands::all(['id', 'name']);
        $categories = Categories::all(['id', 'name']);
        return view('admin.products.create', compact("brands", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Products();

        $file = $request->file('image');

        $imgFolder = public_path('images/products');
        $imgFile = $request->get('name') . '_' . time() . "." .
            $file->getClientOriginalExtension();
        $file->move($imgFolder, $imgFile);

        $data->image = $imgFile;
        $data->name = $request->get('name');
        $data->description = $request->get('description');
        $data->price = $request->get('price');
        $data->model = $request->get('model');
        $data->ram = $request->get('ram');
        $data->battery_capacity = $request->get('battery');
        $data->cpu = $request->get('cpu');
        $data->screen_size = $request->get('screensize');
        $data->hard_disk = $request->get('hardisk');
        $data->hard_disk_capacity = $request->get('hardisk_capacity');
        $data->graphic_card = $request->get('graphic_card');
        $data->discount = $request->get('discount');
        $data->brands_id = $request->get('brand');
        $data->categories_id = $request->get('category');


        $data->save();

        return redirect()->route('products.create')->with('status', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        $data = $products;
        $brands = Brands::all();
        $categories = Categories::all();
        return view('admin.products.edit', compact("data", "brands", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        if ($request->image) {
            $file = $request->file('image');

            $imgFolder = public_path('images/products');
            $imgFile = $request->get('name') . '_' . time() . "." .
                $file->getClientOriginalExtension();
            $file->move($imgFolder, $imgFile);
            $products->image = $imgFile;
        }

        $products->name = $request->get('name');
        $products->description = $request->get('description');
        $products->price = $request->get('price');
        $products->model = $request->get('model');
        $products->battery_capacity = $request->get('battery');
        $products->cpu = $request->get('cpu');
        $products->ram = $request->get('ram');
        $products->screen_size = $request->get('screensize');
        $products->hard_disk = $request->get('hardisk');
        $products->hard_disk_capacity = $request->get('hardisk_capacity');
        $products->graphic_card = $request->get('graphic_card');
        $products->discount = $request->get('discount');
        $products->brands_id = $request->get('brand');
        $products->categories_id = $request->get('category');
        $products->save();
        return redirect()->route('products.admin')->with('status', 'Data Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        if (!Gate::allows('isAdmin')) {
            return abort(403);
        }
        $products->delete();
        return response()->json(["status" => "success"]);
    }


    public function addToCart(Request $request)
    {
        $id = $request->get('product_id');
        $qty = (int)$request->get('qty');
        $product = Products::find($id);
        $cart = session()->get('cart');

        if ($qty <= 0)
            unset($cart[$id]);
        else
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "qty" => $qty,
                "price" => $product->price,
                "total" => (int) ($product['price'] - ($product['discount'] / 100 * $product['price'])) * $qty,
                "disc" => $product->discount,
                "image" => $product->image
            ];


        session()->put('cart', $cart);

        return redirect()->back()->with('status', 'Product has been added to cart');
    }

    public function deleteCart(Request $request)
    {
        $id = $request->get('product_id');
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('status', 'Product has been removed from cart');
    }
}
