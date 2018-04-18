<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add New Service</h4>
</div>

<div class="modal-body">
    <form id=service-store
        action='/admin/service/store'
        role=form
        onsubmit="event.preventDefault(); Event.$emit('service:save')">

        <div class="box-body">
            <div class="form-group" data-group=name>

                <label for="name">Name</label>
                <input type="text" name=name id=name class=form-control>

            </div>
        </div>

    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="window.Event.$emit('service:save', event)">Save Service</button>
</div>