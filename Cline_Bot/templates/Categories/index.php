<div class="action-buttons">
    <?= $this->Html->link(__('Add New Category'), ['action' => 'add'], ['class' => 'btn-primary']) ?>
    <?= $this->Html->link(__('View Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'btn-secondary']) ?>
</div>

<?= $this->Flash->render() ?>

<?php if (empty($categories)) : ?>
    <div class="flash-message info">
        <strong>No categories found.</strong> <?= $this->Html->link('Add your first category', ['action' => 'add']) ?> to get started.
    </div>

    <div class="text-center mt-4">
        <?= $this->Html->link(__('Add Your First Category'), ['action' => 'add'], ['class' => 'btn-primary']) ?>
    </div>
<?php else : ?>
    <div class="product-table">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name', 'Category Name') ?></th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td>
                            <div class="product-name"><?= h($category->name) ?></div>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $category->id], ['class' => 'btn-small btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ['class' => 'btn-small btn-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], [
                                'confirm' => __('Are you sure you want to delete "{0}"? This action cannot be undone.', $category->name),
                                'class' => 'btn-small btn-danger'
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total')) ?>
        </div>
        <div class="pagination-controls">
            <?= $this->Paginator->first('<< First', ['class' => 'btn-secondary']) ?>
            <?= $this->Paginator->prev('< Previous', ['class' => 'btn-secondary']) ?>
            <?= $this->Paginator->numbers(['class' => 'btn-secondary']) ?>
            <?= $this->Paginator->next('Next >', ['class' => 'btn-secondary']) ?>
            <?= $this->Paginator->last('Last >>', ['class' => 'btn-secondary']) ?>
        </div>
    </div>
<?php endif; ?>
