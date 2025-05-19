<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameInput" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="titleInput" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleInput" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="canLoginInput" class="form-label">Can Login</label>
                        <input type="number" class="form-control" id="canLoginInput" name="can_login">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="saveUserBtn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
