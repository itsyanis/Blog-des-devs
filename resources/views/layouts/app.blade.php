<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
        @yield('style')
    </head>

    <body>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            @include('includes.nav')
        </nav>
        
        <!-- Page Header-->
        @yield('header')


        <!-- Main Content-->
        <main>
            @yield('content')
        </main>

        <!-- Footer-->
        <footer class="border-top">
            @include('includes.footer')           
        </footer>

        <!-- Scripts-->
        @include('includes.scripts')
        @yield('script')
        
    </body>
</html>
