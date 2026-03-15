<div class="page-header">
    <h1 class="page-title">Product Details</h1>
    <p class="page-subtitle">View complete information for <?= h($product->name) ?></p>
</div>

<div class="action-buttons">
    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
</div>

<div class="product-detail-container">
    <div class="product-detail-card">
        <div class="product-detail-header">
            <h2><?= h($product->name) ?></h2>
        </div>

        <div class="product-detail-content">
            <div class="product-detail-section">
                <h3>Basic Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Product ID</span>
                        <span class="detail-value"><?= $this->Number->format($product->id) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Category</span>
                        <span class="detail-value"><?= h($product->category) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Size</span>
                        <span class="detail-value"><?= h($product->size) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Color</span>
                        <span class="detail-value"><?= h($product->color) ?></span>
                    </div>
                </div>
            </div>

            <div class="product-detail-section">
                <h3>Pricing & Inventory</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Price</span>
                        <span class="detail-value price-value">$<?= $this->Number->format($product->price, ['places' => 2]) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Stock Quantity</span>
                        <span class="detail-value"><?= $this->Number->format($product->stock) ?></span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="product-actions-sidebar">
        <h3>Quick Actions</h3>
        <div class="sidebar-actions">
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'btn-primary']) ?>
            <?= $this->Form->postLink(
                __('Delete Product'),
                ['action' => 'delete', $product->id],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $product->name),
                    'class' => 'btn-danger'
                ]
            ) ?>
        </div>
    </div>
</div>
