    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('index') }}">Le Blog des Devs
           {{-- <img class="logo" src="{{ asset('img/logo/')}}" class="mt-0" alt=""> --}}
        </a>
      
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('about') }}">A-propos</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('post.index') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('contact') }}">Contact</a></li>

                @if (Auth::check())
                    <!-- User Dropdown -->
                    <li class="nav-item">
                        {{-- <div class="dropdown"> --}}
                            <!-- User avatar -->
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="#">
                                <i class="fa fa-user"></i>
                                {{ Auth::user()->getFullName() }}                                              
                            </a>
                        
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt"></i> Déconnextion</button>
                                </form>
                            </div>
                        {{-- </div> --}}
                    </li>
                @endif
            </ul>
        </div>
    </div>
