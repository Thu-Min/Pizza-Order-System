@extends('user.layout.style')

@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{ route('user#order') }}">
                <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
            </a>
            <a href="{{ route('user#index') }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            <h4>
                Name : {{ $pizza->pizza_name }}
            </h4>
            <hr>
            <h4>
                Price : {{ $pizza->price }} Kyats
            </h4>
            <hr>
            <h4>
                Discount Price : {{ $pizza->discount_price }}
            </h4>
            <hr>
            <h4>
                Buy One Get One :
                @if ($pizza->buy_one_get_one_status == 0)
                    Not Have
                @else
                    Have
                @endif
            </h4>
            <hr>
            <h4>
                Waiting Time : {{ $pizza->waiting_time }} minute
            </h4>
            <hr>
            <h4>
                Description : {{ $pizza->description }}
            </h4>
            <hr>
            <div class="">
                <h4>
                    Amount :
                    {{ $pizza->price - $pizza->discount_price }}
                </h4>
            </div>
            <hr>
        </div>
    </div>
@endsection
