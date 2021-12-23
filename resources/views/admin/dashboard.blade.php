@extends('layouts.app')

@section('header')
    <header class="masthead" style="background-image: url('../img/dashboard-bg.png')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Espace administrateur</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        
                      <!-- Add Post Button -->
                      <a href="{{ route('post.create') }}" class="btn btn-primary text-uppercase"><i class="fa fa-plus"></i> Ajouter un post</a>
                
                      <!-- Search -->
                      <div class="form-floating mb-5 offset-8">
                        <input type="text" class="form-control" name="search" id="search" placeholder="Enter votre recherche..."/>
                        <label for="search">Recherche</label>
                        <div class="invalid-feedback email-error"></div>
                      </div>

                      <!-- Table Begin -->
                      <table class="table table-image">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">État</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="w-25">
                                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title.'_Image'}}" title="{{ $post->title.'_Image'}}">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author->first_name . ' ' . $post->author->last_name}}</td>
                                    <td>{{ $post->is_published == 0 ? 'Non publié' : 'Publié'}}</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            @php 
                                                $route_show = $post->is_published ? route('post.show', $post->slug) :  route('unpublished.show', $post->slug); 
                                            @endphp
                                            <a href= {{ $route_show }}><i class="fa fa-eye"></i></a>
                                            <a href= {{ route('post.edit', $post->slug) }} ><i class="fa fa-edit" style="color:orange"></i></a>
                                            
                                            <form action="{{ route('post.delete', $post->id) }}" method="DELETE" is-dynamic-form>
                                              @method('DELETE')
                                               <button type="submit" class="button"><i class="fa fa-trash" style="color:red"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>  
                            @endforeach
                        </tbody>
                      </table>   <!-- Table End -->

                      <!-- Pagination -->
                      <div class="pagination">
                        {{ $posts->links('pagination::bootstrap-4') }}
                      </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')

<!-- Custom JS -->
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>    
    

<script type="text/javascript">

$('input[name=search]').keyup(function() {
    
    $.ajaxSetup({
         headers : { 
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         }
    }),

    $.ajax({
        type: 'POST',
        url: '{{ route("admin.search") }}',
        data: { search: $('input[name=search]').val() },
        typeData: 'JSON',
    
        success: function(data) {
          
            $('tbody').html('');

            $.each(data, function(key,post) {
                let is_published = post.is_published == 0 ? 'Non publié' : 'Publié'
                html = `<tr>
                        <td class="w-25">
                            <img src="{{ asset('storage/${post.image}') }}" alt="${post.title}_Image" title="${post.title}_Image">
                        </td>
                        <td> ${post.title}_Image </td>
                        <td> ${post.author.last_name}</td>
                        <td>${is_published} </td>

                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="post/show/${post.slug}"><i class="fa fa-eye"></i></a>
                                <a href="post/edit/${post.slug}"><i class="fa fa-edit" style="color:orange"></i></a>
                                
                                <form action="" method="POST" is-dynamic-form>
                                    @method('DELETE')
                                    <a type="submit"><i class="fa fa-trash" style="color:red"></i></a>
                                </form>
                            </div>
                        </td>
                    </tr>`;

               $('tbody').append(html)
            });
        },

        error: function(post) {
            if(post.status === 422) {
                $.each(post.responseJSON.errors, function(index, errorMsg) {
                    $('[name =' + index + ']').addClass('is-invalid');
                    $('.' + index +'-error').html(errorMsg);
                });
                $("html, body").animate({ scrollTop: $('.is-invalid').offset().top }, "slow");
            }
        }
    });

});

</script>

@endsection