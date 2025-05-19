<button id="addUserBtn" class="btn btn-custom">
    <i class="fas fa-plus"></i> Add User
</button>

<table class="table table-bordered">
    <thead>
    <tr>
        <?php foreach ($columns as $label): ?>
            <th><?= htmlspecialchars($label) ?></th>
        <?php endforeach; ?>
        <th>Options</th>
    </tr>
    </thead>
    <tbody id="userTableBody">
    <?php foreach ($users as $user): ?>
        <?php
        $rowClass = $user->active ? 'table-success' : 'table-danger';
        ?>
        <tr class="clickable-row <?= $rowClass ?>" data-user_id="<?= $user->id ?>">
            <?php foreach ($columns as $column): ?>
                <td class="<?= htmlspecialchars($column) ?>">
                    <?php
                    $value = $user->$column ?? null;
                    echo $value !== null && trim((string)$value) !== '' ? htmlspecialchars((string)$value) : '-';
                    ?>
                </td>
            <?php endforeach; ?>
            <td>
                <?php if (!$user->active): ?>
                    <button class="btn btn-sm btn-success activate-btn" title="Activate">
                        <i class="fas fa-check text-white"></i>
                    </button>
                <?php else: ?>
                    <button class="btn btn-sm btn-danger deactivate-btn" title="Deactivate">
                        <i class="fas fa-times text-white"></i>
                    </button>
                <?php endif; ?>
                <button class="btn btn-sm btn-secondary delete-btn" title="Delete">
                    <i class="fas fa-trash text-white"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<script>
    window.userColumns = <?= json_encode($columns) ?>;
</script>