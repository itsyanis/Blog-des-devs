<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Suppréssion d'article</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div class="modal-body">
          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
          Attention, supprimer un article ne peut être annulé, cette action est irréversible.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        {{-- Delete button  --}}
        <form action="{{ route('post.delete',$post->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>

      </div>
    </div>
  </div>
</div>


@section('script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
@endsection
