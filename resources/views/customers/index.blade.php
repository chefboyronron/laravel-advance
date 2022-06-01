@extends('layouts.app')

@section('page_title', 'Customer List')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Customers</h2> 
            <a href="{{ url('customers/create') }}" class="btn btn-success">Add</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $customers as $customer )
                        <tr>
                            <td>
                                <a href="/customers/{{ $customer->id }}">{{ $customer->name }}</a>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->company->name }}</td>
                            <td>{{ $customer->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $customers->links() }}
        </div>
    </div>

    {{-- <hr> --}}

    {{-- <div class="row">
        <div class="col-6">
            <h4>Active Customers</h4>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $activeCustomers as $customer )
                        @if( $customer->status == 'Active' )
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->company->name }}</td>
                                <td class="text-success">Active</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $activeCustomers->links() }}
        </div>
        <div class="col-6">
            <h4>Inactive Customers</h4>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $inctiveCustomers as $customer )
                        @if( $customer->status == 'Inactive' )
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->company->name }}</td>
                                <td class="text-danger">Inactive</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $inctiveCustomers->links() }}
        </div>
    </div> --}}

    {{-- <hr>
    <h4>Company's Customers</h4>
    <div class="row">
    @foreach( $companies as $company )
        <div class="col-2">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>{{ $company->name }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $company->customers as $customer )
                        <tr>
                            <td>{{ $customer->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    </div> --}}

@endsection

