                            <!-- Add Category Modal -->
                            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
                                aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your form or content for adding a new category here -->
                                            <form action="{{ route('categories.store') }}" method="POST">
                                                @csrf
                                                <!-- Add your form fields for adding a new category -->
                                                <div class="form-group">
                                                    <label for="categoryName">Genre Name</label>
                                                    <input type="text" class="form-control" id="categoryName"
                                                        name="name" required>
                                                </div>
                                                <!-- Add more form fields as needed -->
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
