@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin#pizza') }}" class="text-decoration-none text-dark">
                                <div class="mb-4">
                                    <i class="fas fa-arrow-left"></i>
                                    back
                                </div>
                            </a>
                            <div class="card">

                                <div class="card-header p-2">
                                    <legend class="text-center">Add Pizza</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="post"
                                                action="{{ route('admin#insertPizza') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            name="name">
                                                        @if ($errors->has('name'))
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" placeholder="Name"
                                                            name="image">
                                                        @if ($errors->has('image'))
                                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Price</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Name"
                                                            name="price">
                                                        @if ($errors->has('price'))
                                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Publish
                                                        Status</label>
                                                    <div class="col-sm-9">
                                                        <select name="publish" class="form-control" id="">
                                                            <option value="">Choose Option</option>
                                                            <option value="1">Publish</option>
                                                            <option value="0">Unpublish</option>
                                                        </select>
                                                        @if ($errors->has('publish'))
                                                            <p class="text-danger">{{ $errors->first('publish') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Category</label>
                                                    <div class="col-sm-9">
                                                        <select name="category" class="form-control" id="">
                                                            <option value="">Choose Category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{ $item->category_id }}">
                                                                    {{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('category'))
                                                            <p class="text-danger">{{ $errors->first('category') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Discount</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Name"
                                                            name="discount">
                                                        @if ($errors->has('discount'))
                                                            <p class="text-danger">{{ $errors->first('discount') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Buy One Get
                                                        One</label>
                                                    <div class="col-sm-9">
                                                        <input type="radio" name="buyOneGetOne" class="form-input-check"
                                                            value="1">
                                                        Yes
                                                        <input type="radio" name="buyOneGetOne" class="form-input-check"
                                                            value="0">
                                                        No
                                                        @if ($errors->has('buyOneGetOne'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('buyOneGetOne') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-3 col-form-label">Waiting
                                                        Time</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Name"
                                                            name="waitingTime">
                                                        @if ($errors->has('waitingTime'))
                                                            <p class="text-danger">{{ $errors->first('waitingTime') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName"
                                                        class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                                        @if ($errors->has('description'))
                                                            <p class="text-danger">{{ $errors->first('description') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-3 col-sm-9">
                                                        <button type="submit" class="btn bg-dark text-white">Add</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
