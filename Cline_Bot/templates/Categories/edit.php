<div class="page-header">
    <h1 class="page-title">Edit Category</h1>
</div>

<div class="action-buttons">
    <?= $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
    <?= $this->Html->link(__('View Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'btn-secondary']) ?>
</div>

<div class="form-container">
    <?= $this->Flash->render() ?>

    <?= $this->Form->create($category, ['class' => 'form']) ?>

    <div class="form-section">
        <h3>Category Information</h3>
        <div class="form-grid">
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'form-input' . ($this->Form->isFieldError('name') ? ' error' : ''),
                    'label' => [
                        'text' => 'Category Name *',
                        'class' => 'form-label'
                    ],
                    'placeholder' => 'Enter category name',
                    'required' => true,
                    'maxlength' => 255
                ]) ?>
                <?php if ($this->Form->isFieldError('name')): ?>
                    <div class="form-error"><?= $this->Form->error('name') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <?= $this->Form->control('description', [
                    'class' => 'form-input',
                    'type' => 'textarea',
                    'rows' => '3',
                    'label' => [
                        'text' => 'Description',
                        'class' => 'form-label'
                    ],
                    'placeholder' => 'Enter category description (optional)',
                    'default' => $category->description
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?= $this->Form->button(__('Update Category'), ['class' => 'btn-primary']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn-secondary']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
