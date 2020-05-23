@extends('layouts.app')
@section('content')
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header text-center"><strong>Customers</strong></div>

                    <div class="card-body">
                        @include('includes.messages')
                        @if(count($customers) > 0)
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Phone</th>
                                    <th>Gender</th>
                                    <th>Area</th>
                                    <th>City</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td class="text-capitalize">{{ $customer->gender }}</td>
                                            <td>{{ $customer->area }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <a href="{{ route('admin.customer.show', $customer->id) }}"><i class="fas text-primary fa-eye"></i></a>
                                                    <a href="{{ route('admin.customer.edit', $customer->id) }}"><i class="fas text-warning fa-edit"></i></a>
                                                    <a href="{{ route('admin.customer.destroy', $customer->id) }}"><i class="fas text-danger fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">No customers found!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
