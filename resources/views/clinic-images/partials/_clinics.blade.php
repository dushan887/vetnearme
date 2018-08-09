<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Images To Gallery</h4>
</div>

<div class="modal-body">
    <form action="/admin/clinic-gallery/store"
        id="clinic-gallery"
        role=form
        data-action=update
        onsubmit="event.preventDefault(); Event.$emit('clinic-gallery:store')"
    >

    <input type="hidden" name="mediaID" id=mediaID value="{{ $mediaID }}">

    <div class="box-body">
        <div class="form-group" data-group=name>

            <label for="clinics">Clinics</label>
            <select name="clinics[]" id="clinics" class=form-control multiple>
                @foreach ($clinics as $clinic)

                    <?php
                        $images   = array_column($clinic->gallery->toArray(), 'id');
                        $selected = in_array($mediaID, $images) ? 'selected': '';
                    ?>
                    <option value="{{ $clinic->id }}"
                        {{ $selected }}
                        >{{ $clinic->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="window.Event.$emit('clinic-gallery:store')">Update Gallery</button>
</div>