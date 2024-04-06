<form action="{{ route('adminCategoryUpdate', $category_content->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row mb-2">
        <div class="col-12">
            <label class="col-form-label">Image <span style="color:green;">(To keep the previous picture left this blank)</span></label>
            <div class="custom-file mb-1">
                <input type="file" class="custom-file-input" name="category_image">
                <label class="custom-file-label" for="coverImage">Category Images...</label>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="firstName">Category Name</label>
                <input type="text" class="form-control" name="category_name"
                    value="{{ $category_content->category_name }}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="lastName">Meta Tag</label>
                <input type="text" class="form-control" name="meta_tag" value="{{ $category_content->meta_tag }}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-4">
                <label for="userName">Meta Description</label>
                <textarea class="form-control" name="meta_description" cols="30" rows="5" style="width: 100%">{{ $category_content->meta_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="padding:0;">
        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-pill">Update Category</button>
    </div>
</form>
