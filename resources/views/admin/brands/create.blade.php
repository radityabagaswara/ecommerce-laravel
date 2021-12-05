@extends('layouts.admin')


@section('title')
    Create Brands - BukaLaptop.com
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
                <h6>Add Brand</h6>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('brands.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input class="form-input" type="text" name='name' required>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-input" type="file" name='image' required>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
