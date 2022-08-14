@extends('user.layout.style')

@section('content')
    <div class="row mt-5 d-flex justify-content-center">


        <div class="col-4 ">
            <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{ route('user#index') }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            @if (Session::has('totalTime'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Order Success! Please wait {{ Session::get('totalTime') }} Minutes
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h4>
                Name : {{ $pizza->pizza_name }}
            </h4>
            <hr>
            <h4>
                Price : {{ $pizza->price - $pizza->discount_price }} Kyats
            </h4>
            <hr>
            <h4>
                Waiting Time : {{ $pizza->waiting_time }} minute
            </h4>
            <hr>
            <form action="" method="post">
                @csrf
                <h4>
                    Qty :
                    <input type="number" name="quantity" id="" class="form-control">
                </h4>
                @if ($errors->has('quantity'))
                    <p class="text-danger">{{ $errors->first('quantity') }}</p>
                @endif
                <hr>
                <h4>
                    Payment Method :
                </h4>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="inlineCheckbox1" value="1">
                    <label class="form-check-label" for="inlineCheckbox1">Visa</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="inlineCheckbox2" value="2">
                    <label class="form-check-label" for="inlineCheckbox2">Cash on Deli</label>
                </div>
                @if ($errors->has('paymentMethod'))
                    <p class="text-danger">{{ $errors->first('paymentMethod') }}</p>
                @endif
                <hr>
                <button type="submit" class="btn btn-primary float-start mt-2">
                    <i class="fas fa-shopping-cart"></i> Order Now
                </button>
            </form>
        </div>
    </div>
@endsection
