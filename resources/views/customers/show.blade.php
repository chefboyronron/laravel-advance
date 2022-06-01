@extends('layouts.app')

@section('page_title', 'Details for Customer ' . $customer->name)

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Details for Customer {{ $customer->name }}</h2>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12 mb-2">
            <a href="/customers">< Back to list</a>
        </div>
        <div class="col-3">
            <table class="table table-dark">
                @if( $customer->image )
                    <tr>
                        <td colspan="2">
                            <img src="{{ asset('storage/' . $customer->image) }}" alt="{{ $customer->name }}" class="img-fluid mx-auto d-block">
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>ID:</td>
                    <td>{{ $customer->id }}</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <td>Company:</td>
                    <td>{{ $customer->company->name }}</td>
                </tr>
            </table>
        </div>
        <div class="col-3">
            <form action="/customers/{{ $customer->id }}" method="POST">
                @method('DELETE')
                @csrf
                <a href="/customers/{{ $customer->id }}/edit" class="btn btn-primary">Edit</a>
                <button class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>

@endsection