<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="userModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="form-group">
                        <label for="nameInput">Name</label>
                        <input type="text" class="form-control" id="nameInput" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="titleInput">Title</label>
                        <input type="text" class="form-control" id="titleInput" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="canLoginInput">Can Login</label>
                        <input type="number" class="form-control" id="canLoginInput" name="can_login">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="saveUserBtn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
