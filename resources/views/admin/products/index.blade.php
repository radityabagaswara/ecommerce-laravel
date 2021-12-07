@extends('layouts.admin')


@section('title')
    Admin Products - BukaLaptop.com
@endsection

@section('content')
    <div class="px-3">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3"></span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>

            </div>
        @endif
        <div class="mb-5">
            <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Brand
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Discount
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 object-contain"
                                                        src="{{ asset('images/products/' . $product->image) }}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $product->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $product->brand->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $product->category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Rp {{ number_format($product->price) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $product->discount }} %
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Rp
                                            {{ number_format($product->price - ($product->discount / 100) * $product->price) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ url('admin/products/edit/' . $product->id) }}"
                                                class="btn btn-primary mr-5">Edit</a>

                                            <button onclick="delData({{ $product->id }})"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach


                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function delData(id) {
            Swal.fire({
                icon: "warning",
                title: "Are you Sure?",
                text: "Deleted data can't be recover!",
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{{ url('admin/products/delete/${id}') }}`,
                        success: function(res) {
                            if (res.status === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: "Data Deleted successfully",
                                }).then(res => {
                                    if (res.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }
                        },
                        error: function(res) {
                            console.log(res)
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: JSON.parse(res.responseText).status,
                            }).then(res => {
                                if (res.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                } else {
                    return false;
                }
            })
        }
    </script>

@endsection
