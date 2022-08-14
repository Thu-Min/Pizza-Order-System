@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-7 offset-3 mt-5">
                        <div class="col-md-10">
                            <a href="{{ route('admin#pizza') }}" class="text-decoration-none text-dark">
                                <div class="mb-4">
                                    <i class="fas fa-arrow-left"></i>
                                    back
                                </div>
                            </a>

                            <div class="card">

                                <div class="card-header p-2">
                                    <legend class="text-center">Pizza Info</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="float-start">
                                                <img src="{{ asset('uploads/' . $pizza->image) }}" alt=""
                                                    style="width: 180px; height: 150px;" class="rounded img-thumbnail">
                                            </div>
                                            <div class="" style="margin-left: 200px;">
                                                <div class="my-3 fs-5">
                                                    <b>Name</b> : <span>{{ $pizza->pizza_name }}</span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Pice</b> : <span>{{ $pizza->price }} Kyats</span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Publish Status</b> :
                                                    <span>
                                                        @if ($pizza->publish_status == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Category</b> : <span>{{ $pizza->category_id }}</span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Discount Price</b> : <span>{{ $pizza->discount_price }}</span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Buy One Get One</b> :
                                                    <span>
                                                        @if ($pizza->buy_one_get_one_status == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Waiting Time</b> : <span>{{ $pizza->waiting_time }} Minute</span>
                                                </div>
                                                <div class="my-3 fs-5">
                                                    <b>Description</b> : <span>{{ $pizza->description }}</span>
                                                </div>
                                            </div>

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
