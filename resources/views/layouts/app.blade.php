<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        @yield('style')
    </head>

    <body>

        <!-- Navigation-->
        @if (Request::is('admin/*'))
            <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                @include('includes.admin-sidebar')
            </nav>
        @else
            <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
                @include('includes.nav')
            </nav>
        @endif

        
        <!-- Page Header-->
        @yield('header')

        <!-- Main Content-->
        <main>
            @yield('content')
        </main>

        <!-- Footer-->
        @if (Request::is('admin/*'))
            </div>
        @else
            <footer class="border-top">
                @include('includes.footer')           
            </footer>
        @endif

        <!-- Scripts-->
        @include('includes.scripts')
        
    </body>
</html>
