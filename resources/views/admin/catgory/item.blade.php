@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-2">
                        <h3>
                            {{ $pizza[0]->categoryName }}
                        </h3>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="d-inline">Total {{ $pizza->total() }}</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Pizza Name</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pizza as $item)
                                            <tr>
                                                <td>{{ $item->category_id }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/' . $item->image) }}"
                                                        style="width: 100px;" alt="">
                                                </td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3 ms-3">
                                    {{ $pizza->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('admin#category') }}">
                                    <button class="btn btn-dark">Back</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
