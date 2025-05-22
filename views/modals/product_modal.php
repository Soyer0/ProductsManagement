<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="productModalLabel">Products</h4>
            </div>
            <div class="modal-body">

                <div id="dynamicFieldsContainer"></div>

                <div style="margin-top: 20px;">
                    <label for="new-mpn-input" class="control-label text-danger" style="font-weight: bold;">Add new MPN</label>
                    <div class="input-group">
                        <input
                                type="text"
                                id="new-mpn-input"
                                class="form-control"
                                style="border-color: #d9534f;"
                                placeholder="New MPN">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" id="addMpnBtn" title="Add">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
