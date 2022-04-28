@extends('layouts.app')

@section('content')

    <!-- Page Content  -->
  <div id="content" class="p-3 pt-5">

    <div class="container">
      <h2 class="mb-5">Catégories : </h2>

      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Categorie</th>
              <th scope="col">Date de création</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td class="font-weight-bold"> {{ '# '.$category->id }}</td>
                <td> {{  $category->name }}</td>                
                <td>
                  {{ $category->name }}
                  <small class="d-block">{{  $category->slug }}</small>
                </td>
                <td>{{ $category->created_at }}</td>
            
                <td>
                  <a href="button" class="btn btn-sm">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                  <a href="button" class="btn btn-sm">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                </td>
              </tr> 
            @endforeach
          </tbody>
        </table>
      </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
    </div>

   
  </div>
</div>
@endsection





