$(document).ready(function () {
    $('#productTableBody').on('click', '.clickable-row', function () {
        const productId = $(this).data('product_id');

        $('#new-mpn-input').attr('data-product_id', productId);
        ajaxGetProduct(productId);
    });

    $('#addMpnBtn').on('click', function () {
        const $input = $('#new-mpn-input');
        const newMpn = $input.val();
        const productId = $input.attr('data-product_id');
        if (newMpn.trim() === '') {
            showModal('customWarningModal','Please enter a MPN');
            return;
        }

        ajaxAddProductMpn(productId, newMpn, function () {
            $input.val('');
        })
    });

    $('#productModal').off('change', '.mpn-input').on('change', '.mpn-input', function () {
        const $input = $(this);
        const newMpn = $input.val().trim();
        const id = $input.data('id');

        if (newMpn === '') {
            ajaxDeleteProductMpn(id);
        } else {
            ajaxUpdateProductMpn(id, newMpn);
        }
    });
});
