@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-4">
                    @if (Session::has('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('deletePizza'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('deletePizza') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('pizzaUpdate'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('pizzaUpdate') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin#createPizza') }}">
                                        <button class="btn btn-dark"><i class="fas fa-plus"></i></button>
                                    </a>
                                </h3>

                                <h4 class="d-inline mt-1 ms-3">Total {{ $pizza->total() }}</h4>


                                <div class="card-tools d-flex">
                                    <a href="{{ route('admin#pizzaDownload') }}">
                                        <button class="btn btn-sm btn-success me-3 mt-1">Download CSV</button>
                                    </a>

                                    <form action="{{ route('admin#searchPizza') }}" method="post">
                                        @csrf
                                        <div class="input-group input-group-sm mt-1" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
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
                                            <th>Pizza Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Publish Status</th>
                                            <th>Buy 1 Get 1 Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($status == 0)
                                            <tr>
                                                <td colspan="7">
                                                    <h3 class="text-muted">There's No Data.</h3>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($pizza as $item)
                                                <tr>
                                                    <td>{{ $item->pizza_id }}</td>
                                                    <td>{{ $item->pizza_name }}</td>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . $item->image) }}"
                                                            class="img-thumbnail" width="100px">
                                                    </td>
                                                    <td>{{ $item->price }} kyats</td>
                                                    <td>
                                                        @if ($item->publish_status == 1)
                                                            Publish
                                                        @elseif ($item->publish_status == 0)
                                                            Unpublish
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->publish_status == 1)
                                                            Yes
                                                        @elseif ($item->publish_status == 0)
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin#infoPizza', $item->pizza_id) }}">
                                                            <button class="btn btn-sm bg-dark text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                    <path
                                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                </svg>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#updatePizzaPage', $item->pizza_id) }}">
                                                            <button class="btn btn-sm bg-primary text-white"><i
                                                                    class="fas fa-edit"></i></button>
                                                        </a>
                                                        <a href="{{ route('admin#deletePizza', $item->pizza_id) }}">
                                                            <button class="btn btn-sm bg-danger text-white"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div>
                                    {{ $pizza->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
