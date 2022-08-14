@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <h3 class="my-2 text-center">User List</h3>
                        <div class="card">
                            @if (Session::has('deleted'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('deleted') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-header">
                                <a href="{{ route('admin#userList') }}">
                                    <button class="btn btn-sm btn-outline-primary mx-1 my-2">User List</button>
                                </a>
                                <a href="{{ route('admin#adminList') }}">
                                    <button class="btn btn-sm btn-outline-primary mx-1 my-2">Admin List</button>
                                </a>

                                <div class="card-tools">
                                    <form action="{{ route('admin#userSearch') }}" method="get">
                                        @csrf
                                        <div class="input-group input-group-sm mt-2" style="width: 150px;">
                                            <input type="text" name="searchData" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>
                                                    <a href="{{ route('admin#userDelete', $item->id) }}">
                                                        <button class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 ms-3">{{ $user->links() }}</div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
