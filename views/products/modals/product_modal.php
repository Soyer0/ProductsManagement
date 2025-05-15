<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="dynamicFieldsContainer"></div>

                <div class="mt-4">
                    <label for="new-mpn-input" class="form-label text-danger fw-bold">Add new MPN</label>
                    <div class="input-group">
                        <input
                            type="text"
                            id="new-mpn-input"
                            class="form-control border-danger"
                            placeholder="New MPN">
                        <button class="btn btn-outline-danger" type="button" id="addMpnBtn" title="Add">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
