<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booklist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Add your form fields for adding a new book -->
                    <div class="form-group">
                        <label for="bookTitle">Book Code</label>
                        <input type="text" class="form-control" id="bookTitle" name="book_code"
                            value="{{ old('book_code') }}" required>
                    </div>


                    <div class="form-group">
                        <label for="authorName">Book Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Categories</label><br>
                        @foreach ($categories as $item)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="category_{{ $item->id }}"
                                    name="categories[]" value="{{ $item->id }}">
                                <label class="form-check-label"
                                    for="category_{{ $item->id }}">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="cover">Book Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            onchange="previewImage()">
                        <div
                            style="width: 300px; height: 200px; margin: 10px auto; display: flex; align-items: center; justify-content: center;">
                            <img id="preview" src="#" alt="Preview"
                                style="max-width: 100%; max-height: 100%; display: none;">
                        </div>
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script for preview image --}}
<script>
    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
