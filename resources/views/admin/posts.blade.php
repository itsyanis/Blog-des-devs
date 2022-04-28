@extends('layouts.app')

@section('content')

<!-- Page Content  -->
<div id="content" class="p-3 pt-5">
  <div class="container">
    <h2>Liste des posts : </h2>

    <a href="" type="button" class="btn btn-dark btn-sm float-right mb-3">+ Ajouter un nouveau post</a>

    <form class="form-inline" method="POST">
      @csrf
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </div>
        <input type="text" name="search" class="form-control" placeholder="Chercher" aria-describedby="basic-addon1">
      </div>
    </form>
    <div class="mt-5 table-responsive">
      <table class="table custom-table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Categorie</th>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td class="font-weight-bold"> {{ '# '.$post->id }}</td>
              <td> {{ $post->category->name }}</td>                
              <td>
                {{ $post->title }}
                <small class="d-block">{{  $post->subtitle }}</small>
              </td>
              <td>{{ $post->author->last_name }}</td>
              <td>
                <span class="badge badge-{{ $post->getStatusColor() }}">{{  $post->getStatusName() }}</span>
              </td>

              <td>
                <div class="d-flex">
                  <a href="{{ route('post.show', $post->slug) }}" class="btn btn-sm">                  
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>
                  <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-sm">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
  
                  <form action="{{ route('post.delete', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection





