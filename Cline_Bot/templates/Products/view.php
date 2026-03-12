<div class="products view content">
    <h3><?= h($product->name) ?></h3>
    <table>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($product->category) ?></td>
        </tr>
        <tr>
            <th><?= __('Size') ?></th>
            <td><?= h($product->size) ?></td>
        </tr>
        <tr>
            <th><?= __('Color') ?></th>
            <td><?= h($product->color) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock') ?></th>
            <td><?= $this->Number->format($product->stock) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
    </table>
    <div class="actions">
        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ['class' => 'button']) ?>
        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
            'class' => 'button'
        ]) ?>
        <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'button']) ?>
    </div>
</div>
