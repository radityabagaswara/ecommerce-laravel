<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brands::All();

        return view('admin.brands.index', compact('data'));
    }

    public function adminIndex()
    {
        if (Gate::allows('isAdmin')) {
            $brands_raw = Brands::all();
            $brands = [];

            foreach ($brands_raw as $brand) {
                $brand['total_product'] = $brand->products->count();
                $brands[] = $brand;
            }

            return view('admin.brands.index', compact('brands'));
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.brands.create');
        } else {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Brands();

        $file = $request->file('image');

        $imgFolder = public_path('images/brands');
        $imgFile = $request->get('name') . '_' . time() . "." .
            $file->getClientOriginalExtension();
        $file->move($imgFolder, $imgFile);
        $data->image = $imgFile;


        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('brands.create')->with('status', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brands)
    {
        $data = $brands;
        return view('admin.brands.edit', compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brands $brands)
    {

        if ($request->image) {
            $file = $request->file('image');

            $imgFolder = public_path('images/brands');
            $imgFile = $request->get('name') . '_' . time() . "." .
                $file->getClientOriginalExtension();
            $file->move($imgFolder, $imgFile);
            $brands->image = $imgFile;
        }

        $brands->name = $request->get('name');
        $brands->save();
        return redirect()->route('brands.admin')->with('status', 'Data Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brands)
    {
        if (!Gate::allows('isAdmin')) {
            return abort(403);
        }
        try {
            $brands->delete();
            return response()->json(["status" => "success"]);
        } catch (\PDOException $e) {
            $this->handleAllRemoveChild($brands);
            return response()->json(["status" => "success"]);
        }
    }

    public function handleAllRemoveChild($s)
    {
        $s->products()->delete();
        $s->delete();
        return "Deleted!";
    }
}
