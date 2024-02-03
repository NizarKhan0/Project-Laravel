<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $item->slug }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel{{ $item->slug }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $item->slug }}">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your delete confirmation message here -->
                <p>Are you sure you want to delete the category "{{ $item->name }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('categories.softDelete', $item->slug) }}" method="" {{-- method not post/get because I use modal that redirect same page --}}
                    style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
