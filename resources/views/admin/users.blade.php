@extends('layouts.app')

@section('content')

<!-- Page Content  -->
<div id="content" class="p-3 pt-5">

    <div class="container">
      <h2 class="mb-5">Utilisateurs : </h2>

      <div class="table-responsive">

        <table class="table custom-table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nom</th>
              <th scope="col">email</th>
              <th scope="col">role</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($users as $user)
              <tr>
                <td class="font-weight-bold"> {{ '# '.$user->id }}</td>
                <td> {{  $user->getFullName() }}</td>                
                <td>{{  $user->email }}</td>
                <td>
                  <span class="badge badge-{{ $user->role }}">{{  $user->role }}</span>
                </td>
                <td>
                  <a href="button" class="btn btn-sm">                  
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </a>
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
                  {{ $users->links() }}
                </div>
    </div>

   
  </div>
</div>
@endsection





