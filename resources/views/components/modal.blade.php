<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="img-form" action="{{url('/')."/postImg"}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    {{csrf_field()}}
                    <fieldset class="form-group">
                        <label for="tbTitle">Title</label>
                        <input type="text" class="form-control" name="tbTitle">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </fieldset>
                <fieldset class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rbShare" value="1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Share with everybody
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rbShare" value="0">
                    <label class="form-check-label" for="exampleRadios2">
                        Only in gallery
                    </label>
                </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

            </form>
        </div>
    </div>
</div>