<button id="addUserBtn" class="btn btn-primary">
    <i class="fa fa-plus"></i> Add User
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
        $rowClass = $user->active ? 'success' : 'danger';
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
                    <button class="btn btn-xs btn-success activate-btn" title="Activate">
                        <i class="fa fa-check" style="color: white;"></i>
                    </button>
                <?php else: ?>
                    <button class="btn btn-xs btn-danger deactivate-btn" title="Deactivate">
                        <i class="fa fa-times" style="color: white;"></i>
                    </button>
                <?php endif; ?>
                <button class="btn btn-xs btn-default delete-btn" title="Delete">
                    <i class="fa fa-trash" style="color: white;"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    window.userColumns = <?= json_encode($columns) ?>;
</script>