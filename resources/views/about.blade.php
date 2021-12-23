
@extends('layouts.app')

@section('header')
    <header class="masthead" style="background-image: url('img/about-bg.jpeg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>À propos de moi </h1>
                        <span class="subheading">This is what I do.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid rounded-circle" src="{{ asset('img/about_me/Yanis_Maafi.jpg') }}" style="height:120px" alt="Yanis Maafi image" title="Yanis Maafi">
                    </div>
                    <p>Hello 👋 ,<br><br> Je m'appelle Yanis MAAFI, je suis actuellement étudiant en informatique à <a href="https://ecole-ingenieurs.cesi.fr/" target="_blank">CESI École d'ingénieurs</a>.</p>
                    <p>Depuis mon plus jeune âge je suis passionné par l'informatique et les nouvelles technologies 💻</p>
                    <p>J'ai développé <a href="{{ route('index') }}">Le Blog des Devs</a> pour partager avec vous des articles, tutos et pleins de choses en relation avec le développement web.</p>
                    <p>Ne soyer pas étonné si vous la majorité des articles parlera du <a href="https://www.php.net/" target="_blank">langage PHP</a>  et de ses Frameworks 😂 j'ai peut-être oublié de le mentionner mais je suis un amoureux de ce langage ❤️.</p>
                </div>

                <!-- Download CV Button-->
                <form action="{{ route('download_CV') }}" method="POST">
                @csrf
                    <div class="d-flex justify-content-center mb-4">
                        <button type="submit" class="btn btn-primary text-uppercase">Télécharger le CV</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

