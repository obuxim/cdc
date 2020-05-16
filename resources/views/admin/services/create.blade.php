@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">Create New Item</div>

                    <div class="card-body">
                        @include('includes.errors')
                        <form method="POST" action="{{ route('admin.service.store') }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="name">Item Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="col">
                                        <label for="code">Item Code</label>
                                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categories">Services</label>
{{--                                <input type="text" class="form-control" id="categories" name="categories" value="{{ old('categories') }}">--}}
                                <select class="custom-select" multiple="multiple" name="category[]" id="categories">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="regularPrice">Regular Price</label>
                                    </div>
                                    <div class="col">
                                        <label for="urgentPrice">Urgent Price</label>
                                    </div>
                                    <div class="col">
                                        <label for="regularDeliveryTime">Regular Delivery Time (Day/s)</label>
                                    </div>
                                    <div class="col">
                                        <label for="urgentDeliveryTime">Urgent Delivery Time (Day/s)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="regularPrice" name="regularPrice" value="{{ old('regularPrice') }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="urgentPrice" name="urgentPrice" value="{{ old('urgentPrice') }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="regularDeliveryTime" name="regularDeliveryTime" value="{{ old('regularDeliveryTime') }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="urgentDeliveryTime" name="urgentDeliveryTime" value="{{ old('urgentDeliveryTime') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="itemNote">Note to customer (e.g: Don't put fabrics that disburses color)</label>
                                <textarea class="form-control" name="itemNote" id="itemNote">
                                    {{ old('description') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
