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
            <a href="{{ url('admin/staff/create') }}" class="btn btn-primary">Add Staff</a>
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
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $ur)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $ur->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $ur->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $ur->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button onclick="resetPwd({{ $ur->id }})"
                                                class="btn btn-primary mr-5">Reset
                                                Password</button>
                                            <button onclick="delData({{ $ur->id }})"
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
                text: "Are you sure you want to delete this user?",
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
                        url: `{{ url('admin/staff/delete/${id}') }}`,
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

        function resetPwd(id) {
            Swal.fire({
                icon: "warning",
                title: "Are you Sure?",
                text: "Are you sure you want to reset this user?",
                showCancelButton: true,
                confirmButtonText: 'Reset',
                cancelButtonText: 'Cancel',
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{{ url('admin/staff/reset/${id}') }}`,
                        success: function(res) {
                            const temp = document.createElement("input");
                            temp.value = res.new_pwd;
                            document.body.appendChild(temp);
                            temp.select();

                            document.execCommand("copy");
                            document.body.removeChild(temp);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: "Password has been coppied to your clipboard!",
                            }).then(res => {
                                if (res.isConfirmed) {

                                }
                            })
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
