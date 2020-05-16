@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Items</strong></div>

                    <div class="card-body">
                        @include('includes.messages')
                        @if(count($services) > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Item Code</th>
                                    <th>Item Categories</th>
                                    <th>Regular Price</th>
                                    <th>Urgent Price</th>
                                    <th>Regular Delivery Time</th>
                                    <th>Urgent Delivery Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->code }}</td>
                                            <td>
{{--                                                {{ gettype($service->categories()) }}--}}
                                                @foreach($service->categories as $category)
                                                    @if(!$loop->last)
                                                        {{ $category->title }},&nbsp;
                                                    @else
                                                        {{ $category->title }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $service->regularPrice }}/- BDT</td>
                                            <td>{{ $service->urgentPrice }}/- BDT</td>
                                            <td>{{ $service->regularDeliveryTime }} day(s)</td>
                                            <td>{{ $service->urgentDeliveryTime }} day(s)</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <a href="{{ route('admin.service.show', $service->id) }}"><i class="fas text-primary fa-eye"></i></a>
                                                    <a href="{{ route('admin.service.edit', $service->id) }}"><i class="fas text-warning fa-edit"></i></a>
                                                    <a href="{{ route('admin.service.destroy', $service->id) }}"><i class="fas text-danger fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">No services found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
