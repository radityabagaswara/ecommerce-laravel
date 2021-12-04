@extends('layouts.admin')


@section('title')
    Create Categories - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-3">
        <div class="card">

            <div class="card-header">
                <h6>Add Category</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Category Name</label>
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
