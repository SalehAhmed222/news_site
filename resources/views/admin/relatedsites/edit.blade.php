  <!-- start Modal update category -->
  <form method="post" action="{{ route('admin.related-sites.update',$site->id) }}">
    @csrf
    @method('PUT')

    <div class="modal fade" id="update-site-{{$site->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Site: {{$site->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        Name:<input value="{{$site->name}}" name="name" class="form-control"
                            placeholder="Enter site name">
                            <br>

                            Url:<input value="{{$site->url}}" name="url" class="form-control"
                            placeholder="Enter site url">
                            <br>


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
<!-- end Modal create site -->
