
<div class="modal fade" id="field_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Filed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit_f">
            <div class="modal-body">
                <input type="hidden" name="id" id="id_m">
                <div class="row">
                    <div class="col-12">
                        <label for="inlineFormCustomSelectPref">Type</label>
                        <select class="custom-select" id="type_m" name="type" required>
                            <option selected disabled>Choose...</option>
                            @foreach($types as $t)
                                <option value="{{$t->id}}">{{strtoupper($t->type)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="name">Label Name</label>
                        <input type="text" id="label_m" name="label" class="form-control" placeholder="Field Label Name" required>
                    </div>
                    <div class="col-12">
                        <label for="option">Option/Note Details</label>
                        <textarea id="option_m" class="form-control" name="option" rows="3"></textarea>
                        {{--<input type="text"  class="form-control" placeholder="Option will be comma separated">--}}
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button  type="submit" class="btn btn-sm btn-primary" id="sub_btn">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
