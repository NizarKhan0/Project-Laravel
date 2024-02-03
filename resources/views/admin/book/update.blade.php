    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $item->slug }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $item->slug }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('booklist.update', ['slug' => $item->slug]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Add this line for the update method -->

                        <!-- Add your form fields for editing the book -->
                        <div class="form-group">
                            <label for="bookTitle">Book Code</label>
                            <input type="text" class="form-control" id="bookTitle" name="book_code"
                                value="{{ old('book_code', $item->book_code) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="authorName">Book Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $item->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Categories</label><br>
                            @foreach ($categories as $category)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox"
                                        id="edit_category_{{ $category->id }}" name="categories[]"
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id,optional($item->categories)->pluck('id')->toArray() ?? [])? 'checked': '' }}>
                                    <label class="form-check-label"
                                        for="edit_category_{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="cover">Book Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                                onchange="previewImage()">
                            <div
                                style="width: 300px; height: 200px; margin: 10px auto; display: flex; align-items: center; justify-content: center;">
                                <img id="preview"
                                    src="{{ $item->cover ? asset('storage/cover/' . $item->cover) : asset('img/default.jpg') }}"
                                    alt="Preview" style="max-width: 100%; max-height: 100%;">
                            </div>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
