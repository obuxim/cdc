@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col text-left"><a href="{{ route('admin.customer.index') }}"><i class="fas mr-auto fa-arrow-left fa-2x text-danger"></i></a></div>
                            <div class="col text-center"><strong class="mr-auto">Customer Details</strong></div>
                            <div class="col text-right"><a href="{{ route('admin.customer.edit', $user->id) }}"><i class="fas fa-edit fa-2x text-primary"></i></a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.messages')
                        <div class="card-img text-center">
                            <img src="{{ $profile->gravatarURL }}" alt="{{ $profile->firstName }} {{ $profile->lastName }}" width="200" height="200" class="img-fluid my-3 rounded-circle">
                        </div>
                        <form>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName">First Name</label>
                                        <input type="text" name="firstName" readonly id="firstName" class="form-control" value="{{ $profile->firstName }}">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="lastName" readonly id="lastName" class="form-control" value="{{ $profile->lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email" readonly value="{{ $user->email }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <label for="phone">Phone number</label>
                                        <input type="tel" id="phone" name="phone" readonly value="{{ $profile->phone }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="custom-select text-capitalize">
                                            <option value="{{ $profile->gender }}" selected>{{ ucwords(str_replace('-', ' ', $profile->gender)) }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street">Street Address</label>
                                        <input readonly type="text" class="form-control" id="street" name="street" value="{{ $profile->street }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street1">Street Address Line 1</label>
                                        <input readonly type="text" class="form-control" id="street1" name="street1" value="{{ $profile->street1 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="area">Area</label>
                                        <input readonly type="text" class="form-control" id="area" name="area" value="{{ $profile->area }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="city">City</label>
                                        <input readonly type="text" class="form-control" id="city" name="city" value="{{ $profile->city }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="zip">ZIP</label>
                                        <input readonly type="text" class="form-control" id="zip" name="zip" value="{{ $profile->zip }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <button id="updateProfile" class="btn btn-block btn-primary d-none" type="submit">Update</button>
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
