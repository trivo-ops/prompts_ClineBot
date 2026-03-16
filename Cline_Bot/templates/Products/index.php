<div class="action-buttons">
    <?= $this->Html->link(__('Add New Product'), ['action' => 'add'], ['class' => 'btn-primary']) ?>
    <?= $this->Html->link(__('Manage Categories'), ['controller' => 'Categories', 'action' => 'index'], ['class' => 'btn-secondary']) ?>
</div>

<?php if (!empty($products)) : ?>
    <div class="product-grid">
        <?php foreach ($products as $product) : ?>
            <div class="product-card">
                <h3 class="product-name"><?= h($product->name) ?></h3>
                <span class="product-category"><?= h($product->product_category->name ?? 'No Category') ?></span>

                <div class="product-details">
                    <div class="product-detail-item">
                        <span class="product-detail-label">SKU</span>
                        <span class="product-detail-value"><?= h($product->sku ?? 'N/A') ?></span>
                    </div>
                    <div class="product-detail-item">
                        <span class="product-detail-label">Price</span>
                        <span class="product-detail-value">$<?= $this->Number->format($product->price, ['places' => 2]) ?></span>
                    </div>
                </div>

                <div class="product-actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'btn-secondary btn-small']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ['class' => 'btn-secondary btn-small']) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $product->id],
                        [
                            'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                            'class' => 'btn-danger btn-small'
                        ]
                    ) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
<?php else : ?>
    <div class="flash-message info">
        <strong>No products found.</strong> Start by adding your first product to the catalog.
    </div>

    <div class="text-center mt-4">
        <?= $this->Html->link(__('Add Your First Product'), ['action' => 'add'], ['class' => 'btn-primary']) ?>
    </div>
<?php endif; ?>
