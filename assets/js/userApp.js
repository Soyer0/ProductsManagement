$(document).ready(function () {
    $('#userTableBody').on('click', '.activate-btn', function (event) {
        event.stopPropagation();

        const $row = $(this).closest('tr');
        const userId = $row.data('user_id');

        ajaxActivateUser(userId, function () {
            $row.removeClass('danger').addClass('success');
            const newBtn = `
            <button class="btn btn-xs btn-danger deactivate-btn" title="Deactivate">
                <i class="fa fa-times" style="color: white;"></i>
            </button>
        `;
            $row.find('.activate-btn').replaceWith(newBtn);
        });
    });

    $('#userTableBody').on('click', '.deactivate-btn', function (event) {
        event.stopPropagation();

        const $row = $(this).closest('tr');
        const userId = $row.data('user_id');

        ajaxDeactivateUser(userId, function () {
            $row.removeClass('success').addClass('danger');
            const newBtn = `
            <button class="btn btn-xs btn-success activate-btn" title="Activate">
                <i class="fa fa-check" style="color: white;"></i>
            </button>
        `;
            $row.find('.deactivate-btn').replaceWith(newBtn);
        });
    });


    $('#userTableBody').on('click', '.delete-btn', function (event) {
        event.stopPropagation();

        const $row = $(this).closest('tr');
        const userId = $row.data('user_id');

        if (!userId || !$row.length) {
            showModal('customErrorModal', 'User ID or row not found');
            return;
        }

        showModal('deleteConfirmModal', `<p>Are you sure you want to delete user with ID ${userId}?</p>`);

        $('#confirmDeleteBtn').off('click').on('click', function () {
            ajaxDeleteUser(userId, function () {
                $row.remove();
            });
        });
    });

    $('#addUserBtn').on('click', function () {
        $('#userForm')[0].reset();
        switchToAddMode();
        showModal('userModal');
    });

    $(document).on('click', '#saveUserBtn', function () {
        const name = $('#nameInput').val().trim();
        const title = $('#titleInput').val().trim();
        const canLogin = parseInt($('#canLoginInput').val().trim(), 10);

        if (!name || !title || isNaN(canLogin)) {
            showModal('customErrorModal', 'Please fill in correctly Name, Title and Can Login');
            return;
        }

        ajaxAddUser(name, title, canLogin, function (response){
            $('#userModal').modal('hide');

            const user = response.user;
            const newRow = `
            <tr class="clickable-row success" data-user_id="${user.id}">
                ${window.userColumns.map(column => {
                const value = user[column];
                const safeValue = (value !== null && value !== undefined && String(value).trim() !== '')
                    ? $('<div>').text(value).html()
                    : '-';
                return `<td class="${column}">${safeValue}</td>`;
            }).join('')}
                <td>
                    <button class="btn btn-xs btn-danger deactivate-btn" title="Deactivate">
                        <i class="fa fa-times" style="color: white;"></i>
                    </button>
                    <button class="btn btn-xs btn-default delete-btn" title="Delete">
                        <i class="fa fa-trash" style="color: white;"></i>
                    </button>
                </td>
            </tr>`;
            $('#userTableBody').append(newRow);
        });
    });

    $('#userTableBody').on('click', '.clickable-row', function () {
        const userId = $(this).data('user_id');
        ajaxGetUser(userId, function (response){
            const user = response.user;
            switchToEditMode();
            $('#nameInput').val(user.name);
            $('#titleInput').val(user.title);
            $('#canLoginInput').val(user.can_login);

            const isProtectedUser = user.name === 'admin' || user.name === 'manager';
            $('#nameInput')
                .prop('readonly', isProtectedUser)
                .toggleClass('readonly-style', isProtectedUser);

            $('#canLoginInput')
                .prop('readonly', isProtectedUser)
                .toggleClass('readonly-style', isProtectedUser);

            $('#userModal').attr('data-user_id', userId);

            showModal('userModal');
        });
    });

    $('#userModal').on('hidden.bs.modal', function () {
        $('#nameInput')
            .prop('readonly', false)
            .removeClass('readonly-style');

        $('#canLoginInput')
            .prop('readonly', false)
            .removeClass('readonly-style');
    });

    $(document).on('click', '#editUserBtn', function () {
        const userId = $('#userModal').attr('data-user_id');
        const name = $('#nameInput').val().trim();
        const title = $('#titleInput').val().trim();
        const canLogin = parseInt($('#canLoginInput').val().trim(), 10);

        if(!userId){
            showModal('customErrorModal', 'Failed to retrieve user ID.')
        }
        if (!name || !title || isNaN(canLogin)) {
            showModal('customErrorModal', 'Please fill in all fields correctly.');
            return;
        }

        ajaxEditUser(userId, name, title, canLogin, function (response) {
            const editedUser = response.user;
            const $row = $(`#userTableBody tr[data-user_id="${userId}"]`);

            if (!$row.length) {
                showModal('customErrorModal', 'Row not found for update.');
                return;
            }

            window.userColumns.forEach(column => {
                if (column === 'id') return;
                const $cell = $row.find(`td.${column}`);
                const value = editedUser[column];

                const safeValue = (value !== null && value !== undefined && String(value).trim() !== '')
                    ? $('<div>').text(value).html()
                    : '-';

                $cell.html(safeValue);
            });

            $('#userModal').modal('hide');
        })
    });
});
