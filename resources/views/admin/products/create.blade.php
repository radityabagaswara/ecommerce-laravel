@extends('layouts.admin')


@section('title')
    Create Products - BukaLaptop.com
@endsection

@section('content')
    <div class="px-3">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">Data Successfully Saved!</span>

            </div>
        @endif
        <div class="card">

            <div class="card-header">
                <h6>Add Products</h6>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-input" type="text" name='name' required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-input" type="text" name='description' required>
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select id="brand" name="brand">
                            <option value=""></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select id="category" name="category">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-input" type="file" name='image' required>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-input" type="number" name='price' required>
                    </div>

                    <div class="form-group">
                        <label>Model</label>
                        <input class="form-input" type="text" name='model' required>
                    </div>

                    <div class="form-group">
                        <label>Battery Capacity</label>
                        <input class="form-input" type="text" name='battery' required>
                    </div>

                    <div class="form-group">
                        <label>CPU</label>
                        <input class="form-input" type="text" name='cpu' required>
                    </div>

                    <div class="form-group">
                        <label>RAM</label>
                        <input class="form-input" type="text" name='ram' required>
                    </div>

                    <div class="form-group">
                        <label>Screen Size</label>
                        <input class="form-input" type="text" name='screensize' required>
                    </div>

                    <div class="form-group">
                        <label>Hardisk</label>
                        <input class="form-input" type="text" name='hardisk' required>
                    </div>

                    <div class="form-group">
                        <label>Hardisk Capacity</label>
                        <input class="form-input" type="text" name='hardisk_capacity' required>
                    </div>

                    <div class="form-group">
                        <label>Graphic Card</label>
                        <input class="form-input" type="text" name='graphic_card' required>
                    </div>

                    <div class="form-group">
                        <label>Discount</label>
                        <input class="form-input" type="number" name='discount' required>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
