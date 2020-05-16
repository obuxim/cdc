@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col"><i id="editProfileToggle" class="fas mr-auto fa-edit fa-2x text-primary"></i></div>
                            <div class="col text-center"><strong class="mr-auto">Profile</strong></div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.messages')
                        <div class="card-img text-center">
                            <img src="{{ $profile->profilePicture ? $profile->profilePicture : $profile->gravatarURL }}" alt="{{ $profile->firstName }} {{ $profile->lastName }}" width="200" height="200" class="img-fluid my-3 rounded-circle">
                        </div>
                        <form id="profileForm" action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="firstName">First Name</label>
                                        <input type="text" name="firstName" readonly id="firstName" class="form-control" value="{{ old('firstName') ? old('firstName') : $profile->firstName }}">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="lastName" readonly id="lastName" class="form-control" value="{{ old('lastName') ? old('lastName') : $profile->lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email" readonly value="{{ old('email') ? old('email') : $user->email }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <label for="phone">Phone number</label>
                                        <input type="tel" id="phone" name="phone" readonly value="{{ old('phone') ? old('phone') : $profile->phone }}" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="custom-select text-capitalize" readonly>
                                            @php $genders = ['male', 'female', 'not-specified']; @endphp
                                            @foreach($genders as $gender)
                                                <option value="{{ $gender }}" @if($gender == $profile->gender) selected @endif>{{ ucwords(str_replace('-', ' ', $gender)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street">Street Address</label>
                                        <input readonly type="text" class="form-control" id="street" name="street" value="{{ old('street') ? old('street') : $profile->street }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="street1">Street Address Line 1</label>
                                        <input readonly type="text" class="form-control" id="street1" name="street1" value="{{ old('street1') ? old('street1') : $profile->street1 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="area">Area</label>
                                        <input readonly type="text" class="form-control" id="area" name="area" value="{{ old('area') ? old('area') : $profile->area }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="city">City</label>
                                        <input readonly type="text" class="form-control" id="city" name="city" value="{{ old('city') ? old('city') : $profile->city }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="zip">ZIP</label>
                                        <input readonly type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') ? old('zip') : $profile->zip }}">
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
