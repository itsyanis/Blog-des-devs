    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Blog, Le Blog des Devs, Blog de dev, Informatique, IT, Développement web, Dev, Web, Dev web, Code, CS, Tutos, Article, Langages, Framework, PHP, Laravel" />
    <meta name="description" content="Le Blog des Devs est un blog consacrés au amoureux du code. Atricle, news, tutos vous serez servis" />
    <meta name="author" content="Le Blog des Devs" />
    <meta name="copyright" content="Yanis MAAFI" />

    <title> Le Blog des Devs </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>

    <!-- Font Awesome icons-->
    <script src="https://kit.fontawesome.com/c2e044a1c3.js" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    @yield('style')