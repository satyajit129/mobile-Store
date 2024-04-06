<form action="{{ route('adminSubcategoryUpdate', $subcategory_content->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="modal-body px-4">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="firstName">Category Name</label>
                    <select class="form-control" id="exampleFormControlSelect12" name="category_id" required>
                        <option value="" disabled> Select Category</option>
                        @foreach ($category_lists as $category_list)
                            <option value="{{ $category_list->id }}" @if ($category_list->id == $subcategory_content->category_id) selected @endif>
                                {{ $category_list->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="firstName">Subcategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name"
                        value="{{ $subcategory_content->subcategory_name }}">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="lastName">Meta Tag</label>
                    <input type="text" class="form-control" name="meta_tag"
                        value="{{ $subcategory_content->meta_tag }}">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-4">
                    <label for="userName">Meta Description</label>
                    <textarea class="form-control" name="meta_description" cols="30" rows="5" style="width: 100%">{{ $subcategory_content->meta_description }}</textarea>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer px-4">
        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-pill">Save Subcategory</button>
    </div>
</form>
