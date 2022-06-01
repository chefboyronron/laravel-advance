@extends('layouts.app')

@section('page_title', 'Add Customer')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Add Customer</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form action="/customers" method="POST" enctype="multipart/form-data">
                @include('customers.form')
                <button type="submit" class="btn btn-primary mb-2">Add Customer</button>
                @csrf
                @method('post')
            </form>
        </div>
    </div>

@endsection