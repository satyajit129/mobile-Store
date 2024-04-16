<form action="{{ route('adminOperatingSystemUpdate',  $operating_system_list->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="modal-body px-4">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="firstName">Category Name</label>
                    <select class="form-control" id="exampleFormControlSelect12" name="category_id"
                        required>
                        <option value="" selected disabled> Select Category </option>
                        @foreach ($category_lists as $category_list)
                            <option value="{{ $category_list->id }}" @if ($category_list->id ==  $operating_system_list->category_id) selected @endif>
                                {{ $category_list->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="firstName">Operating System Name</label>
                    <input type="text" class="form-control" name="operating_system_name" value="{{  $operating_system_list->operating_system_name }}">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="lastName">Meta Tag</label>
                    <input type="text" class="form-control" name="meta_tag" value="{{ $operating_system_list->meta_tag }}">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-4">
                    <label for="userName">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="" cols="30" rows="5" style="width: 100%">{{ $operating_system_list->meta_description }}</textarea>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer px-4">
        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-pill">Update Operating System</button>
    </div>
</form>
