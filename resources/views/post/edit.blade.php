@extends('layouts.app')

@section('style')
    <!-- Dropzone Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('header')
    <header class="masthead" style="background-image: url('/storage/{{ $post->image }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h2>Modifier l'article</h2>
                        <span class="subheading">{{ $post->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-10">
            <p class="text-center form-header">Ecrivez, pendant que vous avez du génie, pendant que c'est le dieu qui vous dicte, et non la mémoire.</p>
            <div class="my-5">
                <form action="{{ route('post.update', $post->slug) }}" method="POST" autocomplete="off" is-dynamic-form>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre :</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Entrer un titre" value="{{ $post->title }}">
                        <div class="invalid-feedback title-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sous-titre :</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Entrer un sous-titre (facultatif)" value="{{ $post->title }}">
                        <div class="invalid-feedback subtitle-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie :</label>
                        <select class="form-select" name="category" id="category" >
                            <option selected hidden>Sléctionnez une catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category->id === $category->id ? 'selected' : '' }} > {{ $category->name }}</option>
                            @endforeach
                        </select>   
                        <div class="invalid-feedback category-error"></div>               
                    </div>

                    <div class="mb-3">
                        <label for="tags-input" class="form-label">Tags :</label><br> 

                        <input type="text" class="form-control" name="tags" id="tags-input" value="{{ str_replace(['"','[', ']'],'', json_encode($post->tags)) }}"/> 
                        <div class="invalid-feedback tags-error"></div>               
                    </div>

                    <div class="mb-3">
                        <div class="col-12">
                            <label for="file-dropzone" class="form-label">Image :</label><br>
                            <div class="dropzone" name="image" id="file-dropzone"></div>
                            <div class="invalid-feedback image-error"></div>               
                        </div>                    
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu :</label>
                        <textarea name="content" id="editor" > {!! $post->content !!}</textarea>
                        <div class="invalid-feedback content-error"></div>               
                    </div>

                    <!-- Submit Button-->
                    <button type="submit" class="btn btn-primary text-uppercase">Modifier le contenu</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <!-- Custom JS -->
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>    
    
    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <!-- Tags Input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>
  
    <!-- CKEditor 4 -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>    
   
    <script>
    
        CKEDITOR.replace( 'editor', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
 
       /*------ Dzopzone ------*/
        Dropzone.options.fileDropzone = {
            url: '{{ route('dropzone.store') }}',
            acceptedFiles: ".jpeg, .jpg, .png, .gif",
            maxFilesize: 8,
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            renameFile: function(file) {
                var dt = new Date();
                var newFileName = dt.getTime() + '_' + file.name;
                return newFileName;
            },

            // Get post files
            init:function() {
                var myDropzone = this;
                
                $.ajax({
                    url: '{{ route("post.edit", $post->slug) }}', 
                    type: 'GET',
                    dataType: 'JSON',

                    success: function(data){
                        if(data.file != null) {

                            let fileName = data.file;
                            let file_path = "{{ asset('storage/:path') }}".replace(':path', fileName)

                            myDropzone.options.addedfile.call(myDropzone, data);
                            myDropzone.options.thumbnail.call(myDropzone, data, file_path);
                            myDropzone.emit("complete", data);
                            $('.dropzone img').css("height",90);
                            $('.dropzone img').css("width",120);
                        }
                    }
                });
            },

            removedfile: function (file) {
                file.previewElement.remove();
            }
        }

  </script>

@endsection