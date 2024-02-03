    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $item->slug }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $item->slug }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->slug }}">Edit
                        Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your edit form or content here -->
                    <form action="{{ route('categories.update', $item->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Add your form fields for editing -->
                        <div class="form-group">
                            <label for="editCategoryName">Category
                                Name</label>
                            <input type="text" class="form-control" id="editCategoryName" name="name"
                                value="{{ $item->name }}">
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Save
                            Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
