<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add New Service</h4>
</div>

<div class="modal-body">
    <form id=post-category action='/admin/post-categories/update/{{ $category->id }}' role=form onsubmit="event.preventDefault(); Event.$emit('post-category:save')"
        data-action=update>

        <div class="box-body">
            <div class="form-group" data-group=name>

                <label for="name">Name</label>
                <input type="text" name=name id=name class=form-control value="{{ $category->name }}">
            </div>
        </div>

    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="window.Event.$emit('post-category:save')">Update Service</button>
</div>