@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col"><a href="{{ route('admin.customer.index') }}"><i class="fas mr-auto fa-arrow-left fa-2x text-danger"></i></a></div>
                            <div class="col text-center"><strong class="mr-auto">Create Customer</strong></div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.messages')
                        <form action="{{ route('admin.customer.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName">First Name</label>
                                        <input type="text" name="firstName" id="firstName" class="form-control" value="{{ old('firstName') }}">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="lastName" id="lastName" class="form-control" value="{{ old('lastName') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <label for="phone">Phone number</label>
                                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="custom-select text-capitalize">
                                            @php $genders = ['male', 'female', 'not-specified']; @endphp
                                            @foreach($genders as $gender)
                                                <option value="{{ $gender }}">{{ ucwords(str_replace('-', ' ', $gender)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street">Street Address</label>
                                        <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street1">Street Address Line 1</label>
                                        <input type="text" class="form-control" id="street1" name="street1" value="{{ old('street1') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="area">Area</label>
                                        <input type="text" class="form-control" id="area" name="area" value="{{ old('area') }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="zip">ZIP</label>
                                        <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-primary" type="submit">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
