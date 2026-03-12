<div class="products index content">
    <h3><?= __('Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', __('ID')) ?></th>
                    <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                    <th><?= $this->Paginator->sort('category', __('Category')) ?></th>
                    <th><?= $this->Paginator->sort('price', __('Price')) ?></th>
                    <th><?= $this->Paginator->sort('stock', __('Stock')) ?></th>
                    <th><?= $this->Paginator->sort('size', __('Size')) ?></th>
                    <th><?= $this->Paginator->sort('color', __('Color')) ?></th>
                    <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $this->Number->format($product->id) ?></td>
                    <td><?= h($product->name) ?></td>
                    <td><?= h($product->category) ?></td>
                    <td><?= $this->Number->format($product->price) ?></td>
                    <td><?= $this->Number->format($product->stock) ?></td>
                    <td><?= h($product->size) ?></td>
                    <td><?= h($product->color) ?></td>
                    <td><?= h($product->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'button view']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ['class' => 'button edit']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], [
                            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
                            'class' => 'button delete'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
    <div class="actions">
        <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'button']) ?>
    </div>
</div>
