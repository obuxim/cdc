@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Services</strong></div>

                    <div class="card-body">
                        @include('includes.messages')
                        @if(count($categories) > 0)
                        @foreach($categories as $category)
                            @if(!$loop->last)
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>{{ $category->title }}</h5>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.category.edit', $category->id) }}"><i class="fas fa-2x fa-edit text-primary"></i></a>
                                        <a href="{{ route('admin.category.destroy', $category->id) }}"><i class="fas fa-2x fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                                <hr>
                            @else
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>{{ $category->title }}</h5>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.category.edit', $category->id) }}"><i class="fas fa-2x fa-edit text-primary"></i></a>
                                        <a href="{{ route('admin.category.destroy', $category->id) }}"><i class="fas fa-2x fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @else
                            <p class="text-center">No services found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
