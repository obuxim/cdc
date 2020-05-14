@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <h3>$category->title</h3>
                        @endforeach
                        @else
                            <p>No categories found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
