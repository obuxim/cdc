@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Edit Item</strong></div>

                    <div class="card-body">
                        @include('includes.messages')
                        <form method="POST" action="{{ route('admin.service.update', $service->id) }}">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="name">Item Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}">
                                    </div>
                                    <div class="col">
                                        <label for="code">Item Code</label>
                                        <input type="text" class="form-control" id="code" name="code" value="{{ $service->code }}">
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
                                        <input type="text" class="form-control" id="regularPrice" name="regularPrice" value="{{ $service->regularPrice }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="urgentPrice" name="urgentPrice" value="{{ $service->urgentPrice }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="regularDeliveryTime" name="regularDeliveryTime" value="{{ $service->regularDeliveryTime }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="urgentDeliveryTime" name="urgentDeliveryTime" value="{{ $service->urgentDeliveryTime }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="itemNote">Note to customer (e.g: Don't put fabrics that disburses color)</label>
                                <textarea class="form-control" name="itemNote" id="itemNote">
                                    {{ $service->itemNote }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('admin.service.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
