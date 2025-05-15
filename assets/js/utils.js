function showModal(modalId, message = '') {
    const $modal = $(`#${modalId}`);
    if (message) $modal.find('.modal-body').html(message);
    $modal.modal('show');
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