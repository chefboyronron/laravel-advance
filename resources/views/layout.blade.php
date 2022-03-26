@include('templates.header')
    <div class="container">
        @include('templates.navigation')
        @yield('content')
    </div>
@include('templates.footer')

