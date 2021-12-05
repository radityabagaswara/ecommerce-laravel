@extends('layouts.admin')


@section('title')
    Admin Brands - BukaLaptop.com
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
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        id
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Products
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $brand->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 object-contain"
                                                        src="{{ asset('images/brands/' . $brand->image) }}" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $brand->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $brand->total_product }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ url('admin/brands/edit/' . $brand->id) }}"
                                                class="btn btn-primary mr-5">Edit</a>

                                            <button onclick="delData({{ $brand->id }})"
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
                text: "Deleting this brand will delete all the products in it!",
                showCancelButton: true,
                confirmButtonText: 'Delete Brand and Products',
                cancelButtonText: 'Cancel',
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{{ url('admin/brands/delete/${id}') }}`,
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
                        }
                    })
                } else {
                    return false;
                }
            })
        }
    </script>
@endsection
