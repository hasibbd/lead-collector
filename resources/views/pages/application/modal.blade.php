
<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="mdl_ttl"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             <div class="row">
                 <div class="col-6 ">
                   <table class="table small table-bordered" id="res_table">
                       <thead>
                       <th>Name</th>
                       <th>Value</th>
                       </thead>
                       <tbody>

                       </tbody>
                   </table>
                 </div>
                 <div class="col-3 ">
                 <div class="card">
                     <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-sm small w-100">
                                    <tr>
                                        <td>Form Name</td>
                                        <td id="a_name"></td>
                                    </tr>
                                    <tr>
                                        <td>Application ID</td>
                                        <td id="a_id"></td>
                                    </tr>
                                    <tr>
                                        <td>Application Status</td>
                                        <td id="a_status"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                         <div id="t_hide">
                             <h6 class="font-weight-bold">Remarks/Note List</h6>
                             <table class="table table-sm small w-100" id="remarks_table">
                                 <tbody>

                                 </tbody>
                             </table>
                         </div>
                         <hr>
                         <form id="remark_submit">
                             <div class="form-group">
                                 <input type="hidden" value="" name="id" id="id">
                                 <label for="remark">Add Remarks/Note</label>
                                 <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                             </div>
                             <div class="text-right">
                                 <button class="btn btn-sm btn-primary" id="rebtn">Add</button>
                             </div>
                         </form>

                     </div>
                 </div>
                 </div>
                 <div class="col-3 ">
                     <div class="card">
                         <div class="card-body">
                             <div >
                                 <h6>Manager</h6>
                                 <table class="table table-sm small w-100" id="man_table">
                                     <tbody>

                                     </tbody>
                                 </table>
                             </div>
                             <div >
                                 <h6>Shareholder</h6>
                                 <table class="table table-sm small w-100" id="sha_table">
                                     <tbody>

                                     </tbody>
                                 </table>
                             </div>
                             <form id="man_submit">
                                 <div class="form-group">
                                     <input type="hidden" value="" name="id" id="id2">
                                     <label for="remark">Name</label>
                                     <input type="text" class="form-control form-control-sm" name="name" required>
                                     <label for="remark">Email</label>
                                     <input type="email" class="form-control form-control-sm" name="email" required>
                                     <label for="remark">Type</label>
                                     <select class="form-control form-control-sm" name="type" required>
                                         <option value="" disabled selected>Select Type..</option>
                                         <option value="1">Manager</option>
                                         <option value="2">Shareholder</option>
                                     </select>
                                 </div>
                                 <div class="text-right">
                                     <button class="btn btn-sm btn-primary" id="mansabtn">Add</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
            </div>
        </div>
    </div>
</div>
