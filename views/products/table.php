<table class="table table-bordered">
    <thead>
    <tr>
        <?php foreach ($columns as $label): ?>
            <th><?= htmlspecialchars($label) ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody id="productTableBody">
    <?php foreach ($products as $product): ?>
        <tr class="clickable-row" data-product_id="<?= $product->id ?>">
            <?php foreach ($columns as $column): ?>
                <td class="<?= htmlspecialchars($column) ?>">
                    <?php
                    $value = $product->$column ?? null;
                    echo $value !== null && trim((string)$value) !== '' ? htmlspecialchars((string)$value) : '-';
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script>
    window.userColumns = <?= json_encode($columns) ?>;
</script>