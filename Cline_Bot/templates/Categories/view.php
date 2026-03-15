<div class="page-header">
    <h1 class="page-title">Category Details</h1>
</div>

<div class="action-buttons">
    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
    <?= $this->Html->link(__('View Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'btn-secondary']) ?>
</div>

<div class="category-detail-container">
    <div class="category-detail-card">
        <div class="category-detail-header">
            <h2><?= h($category->name) ?></h2>
        </div>

        <div class="category-detail-content">
            <div class="category-detail-section">
                <h3>Category Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Category ID</span>
                        <span class="detail-value"><?= h($category->id) ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Description</span>
                        <span class="detail-value"><?= h($category->description ?: 'No description provided') ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Created</span>
                        <span class="detail-value"><?= $category->created ? $category->created->format('M j, Y \a\t g:i A') : 'N/A' ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Modified</span>
                        <span class="detail-value"><?= $category->modified ? $category->modified->format('M j, Y \a\t g:i A') : 'N/A' ?></span>
                    </div>
                </div>
            </div>

            <div class="category-detail-section">
                <h3>Products in this Category</h3>
                <?php if (empty($category->products)) : ?>
                    <div class="flash-message info">
                        No products found in this category.
                    </div>
                <?php else : ?>
                    <div class="product-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($category->products as $product) : ?>
                                    <tr>
                                        <td>
                                            <div class="product-name"><?= h($product->name) ?></div>
                                            <div class="product-category">
                                                <?= h($product->description ?: 'No description') ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="product-detail-value">
                                                <?= $this->Number->currency($product->price) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="product-detail-value">
                                                <?= $this->Number->format($product->stock) ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn-small btn-secondary']) ?>
                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn-small btn-primary']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="category-actions-sidebar">
        <h3>Quick Actions</h3>
        <div class="sidebar-actions">
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'btn-primary']) ?>
            <?= $this->Form->postLink(
                __('Delete Category'),
                ['action' => 'delete', $category->id],
                [
                    'confirm' => __('Are you sure you want to delete {0}?', $category->name),
                    'class' => 'btn-danger'
                ]
            ) ?>
        </div>
    </div>
</div>
