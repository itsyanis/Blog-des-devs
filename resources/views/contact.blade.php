@extends('layouts.app')

@section('style')
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
@endsection

@section('header')
    <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p class="text-center ">
                    Vous voulez entrer en contact ? <br> Remplissez le formulaire ci-dessous pour m'envoyer un message et je vous répondrai dans les plus brefs délais !  
                </p>
                <div class="my-5">
                    <form action="{{ route('contact') }}" method="POST" is-dynamic-form>
                        @csrf
                        <div class="form-floating">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="last_name">Nom</label>
                            <div class="invalid-feedback last_name-error" data-sb-feedback="last_name:required"></div>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="first_name">Prénom</label>
                            <div class="invalid-feedback first_name-error" data-sb-feedback="first_name:required"></div>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                            <label for="email">Adresse email</label>
                            <div class="invalid-feedback email-error"></div>
                        </div>

                        <div class="form-floating">
                            <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number..." data-sb-validations="required" />
                            <label for="phoneNumber">Numéro de téléphone</label>
                            <div class="invalid-feedback phoneNumber-error"></div>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter your subject..." data-sb-validations="required" />
                            <label for="subject">Sujet</label>
                            <div class="invalid-feedback subject-error"></div>
                        </div>

                        <div class="form-floating">
                            <textarea class="form-control" name="message" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback message-error"></div>
                        </div>
                        <br />
                       
                        <!-- Submit Button-->
                        <button type="submit" class="btn btn-primary text-uppercase">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Custom JS -->
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>    
@endsection