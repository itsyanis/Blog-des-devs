@extends('layouts.app')

@section('style')
    <!-- Dropzone Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css" integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
@endsection


@section('header')
    <header class="masthead" style="background-image: url('../img/home-bg.png')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h2>Exprimez-vous</h2>
                        <span class="subheading">Écrire est un apaisement de soi-même.</span>
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
            <h4 class="text-center form-header">Ecrivez, pendant que vous avez du génie, pendant que c'est le dieu qui vous dicte, et non la mémoire.</h4>
            <div class="my-5">
                <form action="{{ route('post.store') }}" method="POST" autocomplete="off" is-dynamic-form>
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('form.label.title') }}</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="{{ __('form.placeholder.title') }}">
                        <div class="invalid-feedback title-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">{{ __('form.label.subtitle') }}</label>
                        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="{{ __('form.placeholder.subtitle') }}">
                        <div class="invalid-feedback subtitle-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('form.label.category') }}</label>
                        <select class="form-select" name="category" id="category" >
                            <option selected hidden>{{ __('form.placeholder.category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>   
                        <div class="invalid-feedback category-error"></div>               
                    </div>

                    <div class="mb-3">
                        <label for="tags-input" class="form-label">{{ __('form.label.tags') }}</label><br>
                        <input type="text" class="form-control" name="tags" id="tags-input"/> 
                        <div class="invalid-feedback tags-error"></div>               
                    </div>

                    <div class="mb-3">
                        <div class="col-12">
                            <label for="file-dropzone" class="form-label">{{ __('form.label.image') }}</label><br>
                            <div class="dropzone" name="image" id="file-dropzone"></div>
                            <div class="invalid-feedback image-error"></div>               
                        </div>                    
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">{{ __('form.label.content') }}</label>
                        <textarea name="content" id="editor" ></textarea>
                        <div class="invalid-feedback content-error"></div>               
                    </div>

                    <!-- Submit Button-->
                    <button type="submit" class="btn btn-primary text-uppercase">{{ __('general.button.add_content') }}</button>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>


    <script type="text/javascript">
      
        CKEDITOR.replace( 'editor', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
 
       /*------ Dzopzone ------*/
        Dropzone.options.fileDropzone = {
            dictDefaultMessage: "Déposer des fichiers ici pour télécharger <br> Upload files here to download",
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
                return newFileName
            },

            removedfile: function(file) {
                var name = file.upload.filename;
              
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dropzone.delete') }}',
                    data: { "_token": "{{ csrf_token() }}", fileName: name},
                
                    success: function (data){
                        console.log('image removed');
                    },

                    error: function (data){
                        return false;
                    },

                });

                var fileRef;
                return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
        }

        // This function will redirect to show-post page after creation
        function redirectToShowPage(post) {
            let route = "{{ route('post.show', ':post') }}".replace(':post',post);
            window.location.href = route;
        }

  </script>

@endsection