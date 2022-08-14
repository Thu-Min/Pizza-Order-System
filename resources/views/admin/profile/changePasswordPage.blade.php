@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-4">
                    <div class="col-6 offset-4 mt-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Change Password</legend>
                                </div>
                                <div class="card-body">
                                    @if (Session::has('notMatch'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('notMatch') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('notSame'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('notSame') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('lengthError'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('lengthError') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="post"
                                                action="{{ route('admin#changePassword', Auth()->user()->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-4 col-form-label">Old
                                                        Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="oldPassword"
                                                            placeholder="Old Password">
                                                        @if ($errors->has('oldPassword'))
                                                            <p class="text-danger">{{ $errors->first('oldPassword') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-4 col-form-label">New
                                                        Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="newPassword"
                                                            placeholder="New Password">
                                                        @if ($errors->has('newPassword'))
                                                            <p class="text-danger">{{ $errors->first('newPassword') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-4 col-form-label">Confirm
                                                        Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="confirmPassword"
                                                            placeholder="Confirm Password">
                                                        @if ($errors->has('confirmPassword'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('confirmPassword') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-4 col-sm-8">
                                                        <button type="submit" class="btn bg-dark text-white">Change</button>
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