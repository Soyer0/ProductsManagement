function ajaxGetProduct(productId){
    $.ajax({
        url: 'index.php?action=getProduct',
        type: 'POST',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
            populateForm(response.products);
            showModal('productModal');
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function ajaxAddProductMpn(productId, newMpn, onSuccess){
    $.ajax({
        url: 'index.php?action=addProductMpn',
        type: 'POST',
        data: {
            productId: productId,
            newMpn: newMpn
        },
        dataType: 'json',
        success: function (response) {
            const $container = $('#dynamicFieldsContainer');
            const inputHtml = `
            <div class="mb-3 border-bottom pb-2">
                <label class="form-label fw-bold">MPN (ID: ${productId})</label>
                <input 
                    type="text" 
                    class="form-control mpn-input" 
                    value="${newMpn}" 
                    data-product_id="${productId}"
                    data-id="${response.id}">
            </div>
        `;
            $container.append(inputHtml);
            if (typeof onSuccess === 'function') onSuccess();
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function ajaxUpdateProductMpn(id, newMpn){
    $.ajax({
        url: 'index.php?action=updateProductMpn',
        type: 'POST',
        data: {
            id: id,
            newMpn: newMpn
        },
        dataType: 'json',
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function ajaxDeleteProductMpn(id){
    $.ajax({
        url: 'index.php?action=deleteProductMpn',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            $(`input[data-id="${id}"]`).closest('.mb-3').remove();
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}