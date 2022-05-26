@include('templates.header')
    <div class="container">
        @include('templates.navigation')
        @if( session()->has('message') )
            <div class="alert alert-success" role="alert">
                <strong>Success</strong> {{ session()->get('message') }}
            </div>
        @endif
        @yield('content')
    </div>
@include('templates.footer')

