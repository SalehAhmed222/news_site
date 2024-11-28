  <!-- start Modal update category -->
  <form method="post" action="{{ route('admin.categories.update',$category->id) }}">
    @csrf
    @method('PUT')

    <div class="modal fade" id="update-category-{{$category->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category: {{$category->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input value="{{$category->name}}" name="name" class="form-control"
                            placeholder="Enter Category Nmae">
                            <br>
                            <select class="form-control" name="status">

                                <option value="1" @selected($category->status==1)>Actice</option>
                                <option value="0" @selected($category->status==0)>Not Active</option>
                            </select>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end Modal create category -->
