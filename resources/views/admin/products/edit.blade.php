@extends('layouts.admin')


@section('title')
    Edit Products - BukaLaptop.com
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
                <div class="h-auto w-32 object-contain">
                    <img src="{{ asset('images/products/' . $data->image) }}">
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('products.update', $data->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-input" type="text" name='name' value="{{ $data->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-input" type="text" name='description' value="{{ $data->description }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select id="brand" name="brand">
                            <option value=""></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $brand->id == $data->brands->id ? 'selected' : '' }}>
                                    {{ $brand->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select id="category" name="category">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $data->categories->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-input" type="file" name='image'>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-input" type="number" name='price' value="{{ $data->price }}" required>
                    </div>

                    <div class="form-group">
                        <label>Model</label>
                        <input class="form-input" type="text" name='model' value="{{ $data->model }}" required>
                    </div>

                    <div class="form-group">
                        <label>Battery Capacity</label>
                        <input class="form-input" type="text" name='battery' value="{{ $data->battery_capacity }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>CPU</label>
                        <input class="form-input" type="text" name='cpu' value="{{ $data->cpu }}" required>
                    </div>

                    <div class="form-group">
                        <label>RAM</label>
                        <input class="form-input" type="text" name='ram' value="{{ $data->ram }}" required>
                    </div>

                    <div class="form-group">
                        <label>Screen Size</label>
                        <input class="form-input" type="text" name='screensize' value="{{ $data->screen_size }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Hardisk</label>
                        <input class="form-input" type="text" name='hardisk' value="{{ $data->hard_disk }}" required>
                    </div>

                    <div class="form-group">
                        <label>Hardisk Capacity</label>
                        <input class="form-input" type="text" name='hardisk_capacity'
                            value="{{ $data->hard_disk_capacity }}" required>
                    </div>

                    <div class="form-group">
                        <label>Graphic Card</label>
                        <input class="form-input" type="text" name='graphic_card' value="{{ $data->graphic_card }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Discount</label>
                        <input class="form-input" type="number" name='discount' value="{{ $data->discount }}"
                            required>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
