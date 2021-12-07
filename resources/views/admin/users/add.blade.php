@extends('layouts.admin')


@section('title')
    Create Pegawai - BukaLaptop.com
@endsection

@section('content')
    <div class="px-3">
        <div class="card">

            <div class="card-header">
                <h6>Create Pegawai</h6>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-input" type="text" name='name' required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-input" type="text" name='email' required>
                    </div>

                    <button class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (session('status'))
        <script>
            const temp = document.createElement("input");
            temp.value = "{{ session('status') }}";
            document.body.appendChild(temp);
            temp.select();

            document.execCommand("copy");
            document.body.removeChild(temp);
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "Password has been coppied to your clipboard!",
            }).then(res => {
                if (res.isConfirmed) {}
            })
        </script>
    @endif
@endsection
