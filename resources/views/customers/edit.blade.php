@extends('layouts.app')

@section('page_title', 'Edit details for ' . $customer->name)

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Edit Customer: {{ $customer->name }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form action="/customers/{{ $customer->id }}" method="POST">
                @include('customers.form')
                <button type="submit" class="btn btn-primary mb-2">Save</button>
                @method('PATCH')
            </form>
        </div>
    </div>

@endsection