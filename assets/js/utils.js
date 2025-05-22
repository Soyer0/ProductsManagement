function showModal(modalId, message = '') {
    const $modal = $('#' + modalId);
    if (!$modal.length) return;
    if (message) {
        $modal.find('.modal-body').html(message);
    }
    $modal.modal('show');
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
            <div class="mpn-wrapper" style="margin-bottom: 15px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                <label class="control-label" style="font-weight: bold;">
                    MPN (ID: ${product.product_id ?? ''})
                </label>
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
