@if (!$post->is_published)

    @extends('layouts.app')

    @section('header')
        <header class="masthead" style="background-image: url('/storage/{{ $post->image }}')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{ $post->title }}</h1>
                            <h2 class="subheading">{{ $post->subtitle }}</h2>
                            <span class="meta">
                                Posté par
                                <a href="#!">{{ $post->author->first_name .' '. $post->author->last_name }}</a>
                                {{ $post->created_at->toFormattedDateString() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endsection

    @section('content')
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        {!! $post->content !!}
                    </div>
                </div>

                <input type="hidden" name="slug" value="{{ $post->slug }}" hidden>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-success text-uppercase" id="publishPost">Publier le contenu</button>
                </div>
            </div>
        </article>
    @endsection


    @section('script')
        <!-- Sweet Alert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">

            $('button[id=publishPost]').click(function() {
                Swal.fire({
                    title: 'Voulez-vous vraiment publier cet article ?',
                    showCancelButton: true,
                    confirmButtonText: `Publier`,

                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url:  '{{ route("post.publish") }}',
                            data: { slug: $('input[name=slug]').val() },
                            typeData: 'JSON',

                            success: function(data) {
                                if(data.notification) {
                                    callToast(data.notification.type, data.notification.message);

                                    setTimeout( function() {
                                        let slug = "{{ $post->slug }}"
                                        let route = "{{ route('post.show',':slug') }}".replace(':slug', slug);
                                        window.location.href = route;
                                    }, 1500);
                                }
                            },

                            error: function(data) {
                                if(data.status === 422) {
                                    Swal.fire('Article publier !', '', 'success')
                                }
                            }
                        })
                    } 
                });
            });

            /* Call Toast Notifier */
            function callToast(type, msg) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                    popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                })

                Toast.fire({
                    icon: type,
                    title: msg
                })
            }
        </script>
    @endsection

@else
    @php 
       return abort(404) 
    @endphp
@endif
