@extends('layouts.admin')


@section('title')
    Edit Brands - BukaLaptop.com
@endsection

@section('content')
    <div class="px-3">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>

            </div>
        @endif
        <div class="card">

            <div class="card-header">
                <h6>Edit Brand</h6>
            </div>
            <div class="card-body">
                <div class="h-auto w-32 object-contain">
                    <img src="{{ asset('images/brands/' . $data->image) }}">
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('brands.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input class="form-input" type="text" name='name' value={{ $data->name }} required>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-input" type="file" name='image'>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
