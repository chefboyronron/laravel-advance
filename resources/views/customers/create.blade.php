@extends('layout')

@section('page_title', 'Add Customer')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Add Customer</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form action="{{ url('customers') }}" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control">
                    {{ $errors->first('name') }}
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control">
                    {{ $errors->first('email') }}
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">-- please select status --</option>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    {{ $errors->first('status') }}
                </div>
                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option value="">-- please select company --</option>
                        @foreach( $companies as $company ) 
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    {{ $errors->first('company_id') }}
                </div>
                <button type="submit" class="btn btn-primary mb-2">Add Customer</button>
                @csrf
                @method('post')
            </form>
        </div>
    </div>

@endsection