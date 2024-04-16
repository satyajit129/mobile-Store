<form action="{{ route('brandUpdate', $brand_content->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-2">

        <div class="col-lg-12">
            <div class="form-group">
                <label for="categorySelect">Category Name</label>
                <select class="form-control" id="categorySelectEdit" name="category_id" required>
                    <option value="" selected disabled> Select Category </option>
                    @foreach ($category_lists as $category_list)
                        <option value="{{ $category_list->id }}" @if ($category_list->id == $brand_content->category_id) selected @endif>
                            {{ $category_list->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="subcategorySelect">Subcategory Name</label>
                <select class="form-control" id="subcategorySelectEdit" name="subcategory_id" required>
                    <option value="" selected disabled> Select Subcategory </option>
                    @foreach ($subcategory_lists as $subcategory_list)
                        <option value="{{ $subcategory_list->id }}"
                            data-category-id="{{ $subcategory_list->category_id }}"
                            @if ($subcategory_list->id == $brand_content->subcategory_id) selected @endif>
                            {{ $subcategory_list->subcategory_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label for="firstName">Brand Name</label>
                <input type="text" class="form-control" name="brand_name" value="{{ $brand_content->brand_name }}">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label for="lastName">Meta Tag</label>
                <input type="text" class="form-control" name="meta_tag" value="{{ $brand_content->meta_tag }}">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group mb-4">
                <label for="userName">Meta Description</label>
                <textarea class="form-control" name="meta_description" cols="30" rows="5" style="width: 100%">{{ $brand_content->meta_description }}</textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer" style="padding:0;">
        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-pill">Update Brand</button>
    </div>
</form>

{{-- Drop Down Content --}}
<script>
    $(document).ready(function() {
        $('#categorySelectEdit').change(function() {
            console.log('okkk');
            var categoryId = $(this).val();
            $('#subcategorySelectEdit option').each(function() {
                if ($(this).data('category-id') == categoryId || categoryId === '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#subcategorySelectEdit').val('').prop('disabled',
                false); // Reset and enable the subcategory select
        });
    });
</script>
