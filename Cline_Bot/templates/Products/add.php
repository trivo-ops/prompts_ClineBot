<div class="page-header">
    <h1 class="page-title">Add New Product</h1>
</div>

<div class="action-buttons">
    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
    <?= $this->Html->link(__('View Dashboard'), ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'btn-secondary']) ?>
</div>

<div class="form-container">
    <?= $this->Flash->render() ?>

    <?= $this->Form->create($product, ['class' => 'form']) ?>

    <div class="form-section">
        <h3>Product Information</h3>
        <div class="form-grid">
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'form-input',
                    'label' => [
                        'text' => 'Product Name *',
                        'class' => 'form-label'
                    ],
                    'placeholder' => 'Enter product name',
                    'required' => true
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('category_id', [
                    'class' => 'form-input',
                    'label' => [
                        'text' => 'Category *',
                        'class' => 'form-label'
                    ],
                    'options' => $categories,
                    'empty' => 'Select a category',
                    'required' => true
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('price', [
                    'class' => 'form-input',
                    'type' => 'number',
                    'step' => '0.01',
                    'min' => '0',
                    'label' => [
                        'text' => 'Price *',
                        'class' => 'form-label'
                    ],
                    'placeholder' => '0.00',
                    'required' => true
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('stock', [
                    'class' => 'form-input',
                    'type' => 'number',
                    'min' => '0',
                    'label' => [
                        'text' => 'Stock Quantity *',
                        'class' => 'form-label'
                    ],
                    'placeholder' => '0',
                    'required' => true
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('size', [
                    'class' => 'form-input',
                    'type' => 'select',
                    'options' => [
                        '' => 'Select Size',
                        'XS' => 'XS',
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                        'XXL' => 'XXL'
                    ],
                    'label' => [
                        'text' => 'Size',
                        'class' => 'form-label'
                    ]
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('color', [
                    'class' => 'form-input',
                    'type' => 'select',
                    'options' => [
                        '' => 'Select Color',
                        'Red' => 'Red',
                        'Blue' => 'Blue',
                        'Green' => 'Green',
                        'Black' => 'Black',
                        'White' => 'White',
                        'Yellow' => 'Yellow',
                        'Purple' => 'Purple',
                        'Orange' => 'Orange',
                        'Pink' => 'Pink',
                        'Brown' => 'Brown',
                        'Gray' => 'Gray',
                        'Navy' => 'Navy',
                        'Beige' => 'Beige'
                    ],
                    'label' => [
                        'text' => 'Color',
                        'class' => 'form-label'
                    ]
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?= $this->Form->button(__('Save Product'), ['class' => 'btn-primary']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
