@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Item Details</strong></div>

                    <div class="card-body">
                        @include('includes.messages')
                        <form>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="name">Item Name</label>
                                        <input type="text" class="form-control" readonly value="{{ $service->name }}">
                                    </div>
                                    <div class="col">
                                        <label for="code">Item Code</label>
                                        <input type="text" class="form-control" readonly value="{{ $service->code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categories">Services</label>
                                <select class="custom-select" multiple="multiple">
                                    @foreach($service->categories as $category)
                                        <option selected>{{ $category->title }}</option>
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
                                        <input type="text" class="form-control" readonly value="{{ $service->regularPrice }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" readonly value="{{ $service->urgentPrice }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" readonly value="{{ $service->regularDeliveryTime }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" readonly value="{{ $service->urgentDeliveryTime }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="itemNote">Note to customer (e.g: Don't put fabrics that disburses color)</label>
                                <textarea class="form-control" readonly>
                                    {{ $service->itemNote }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{ route('admin.service.index') }}">Go back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
