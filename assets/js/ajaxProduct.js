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
            <div class="mpn-wrapper" style="margin-bottom: 15px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                <label class="control-label" style="font-weight: bold;">
                    MPN (ID: ${productId})
                </label>
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
            $(`input[data-id="${id}"]`).closest('.mpn-wrapper').remove();
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}