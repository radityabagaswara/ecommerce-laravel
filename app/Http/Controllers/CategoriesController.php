<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categories::All();

        return view('admin.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.categories.create');
        } else {
            return abort(403);
        }
    }

    public function adminIndex()
    {
        if (Gate::allows('isAdmin')) {
            $categories_raw = Categories::all();
            $categories = [];

            foreach ($categories_raw as $category) {
                $category['total_product'] = $category->products->count();
                $categories[] = $category;
            }
            return view('admin.categories.index', compact('categories'));
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
        $data = new Categories();

        $file = $request->file('image');

        $imgFolder = public_path('images/categories');
        $imgFile = $request->get('name') . '_' . time() . "." .
            $file->getClientOriginalExtension();
        $file->move($imgFolder, $imgFile);

        $data->image = $imgFile;
        $data->name = $request->get('name');

        $data->save();

        return redirect()->route('categories.create')->with('status', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        $data = $categories;
        return view('admin.categories.edit', compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        if ($request->image) {
            $file = $request->file('image');

            $imgFolder = public_path('images/categories');
            $imgFile = $request->get('name') . '_' . time() . "." .
                $file->getClientOriginalExtension();
            $file->move($imgFolder, $imgFile);
            $categories->image = $imgFile;
        }

        $categories->name = $request->get('name');
        $categories->save();
        return redirect()->route('categories.admin')->with('status', 'Data Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {

        if (!Gate::allows('isAdmin')) {
            return abort(403);
        }
        try {
            $categories->delete();
            return response()->json(["status" => "success"]);
        } catch (\PDOException $e) {
            $this->handleAllRemoveChild($categories);
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
