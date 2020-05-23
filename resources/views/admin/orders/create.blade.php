@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col"><a href="{{ route('admin.order.index') }}"><i class="fas mr-auto fa-arrow-left fa-2x text-danger"></i></a></div>
                            <div class="col text-center"><strong class="mr-auto">Create Order</strong></div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.messages')
                        <form action="{{ route('admin.order.store') }}" method="POST">
                            @csrf
                            Number of customers = {{ count($customers) }}
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
