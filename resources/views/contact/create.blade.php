@extends('layouts.app')

@section('page_title', 'Contact Us')

@section('content')
    <h1>Contact Us</h1>
    @if( !session()->has('message') )
        <form action="{{ route('contact.store') }}" method="POST">
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
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>
                {{ $errors->first('message') }}
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Sent Message</button>
        </form>
    @endif
@endsection


