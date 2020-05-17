@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Create New Order Status</strong></div>

                    <div class="card-body">
                        @include('includes.errors')
                        <form method="POST" action="{{ route('admin.orderstatus.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" id="title" name="title" value="{{ old('title') }}">
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
