function showModal(modalId, message = '') {
    const modalElement = document.getElementById(modalId);
    if (!modalElement) return;
    if (message) {
        const body = modalElement.querySelector('.modal-body');
        if (body) body.innerHTML = message;
    }
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    modal.show();
}

function switchToEditMode() {
    $('#userModalLabel').text('Edit User');
    $('#saveUserBtn').replaceWith(`
        <button type="button" id="editUserBtn" class="btn btn-primary">Edit</button>
    `);
}

function switchToAddMode() {
    $('#userModalLabel').text('Add User');
    $('#editUserBtn').replaceWith(`
        <button type="button" id="saveUserBtn" class="btn btn-primary">Save</button>
    `);
}


function populateForm(products) {
    const $container = $('#dynamicFieldsContainer');
    $container.empty();

    products.forEach(product => {
        const inputHtml = `
            <div class="mb-3 border-bottom pb-2">
                <label class="form-label fw-bold">MPN (ID: ${product.product_id ?? ''})</label>
                <input 
                    type="text" 
                    class="form-control mpn-input" 
                    value="${product.mpn ?? ''}" 
                    data-product_id="${product.product_id}"
                    data-id="${product.id}">
            </div>
        `;
        $container.append(inputHtml);
    });
}