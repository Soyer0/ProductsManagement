function ajaxActivateUser(userId, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=activateUser',
        type: 'POST',
        data: { id: userId },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Activation error:', error);
        }
    });
}

function ajaxDeactivateUser(userId, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=deactivateUser',
        type: 'POST',
        data: { id: userId },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Deactivation error:', error);
        }
    });
}

function ajaxDeleteUser(userId, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=deleteUser',
        type: 'POST',
        data: { id: userId },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Deactivation AJAX error:', error);
        }
    });
}

function ajaxAddUser(name, title, canLogin, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=addUser',
        type: 'POST',
        data: {
            name: name,
            title: title,
            canLogin: canLogin,
        },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Adding AJAX error:', error);
        }
    });
}

function ajaxGetUser(userId, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=getUser',
        type: 'POST',
        data: {
            id: userId
        },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Getting AJAX error:', error);
        }
    });
}

function ajaxEditUser(userId, name, title, canLogin, onSuccess) {
    $.ajax({
        url: 'index.php?table=users&action=editUser',
        type: 'POST',
        data: {
            id: userId,
            name: name,
            title: title,
            canLogin: canLogin,
        },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                showModal('customErrorModal', response.error);
            } else {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error('Editing AJAX error:', error);
        }
    });
}