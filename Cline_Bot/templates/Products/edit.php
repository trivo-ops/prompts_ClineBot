<div class="products form content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->control('name', ['required' => true]);
            echo $this->Form->control('category', ['required' => true]);
            echo $this->Form->control('price', ['type' => 'number', 'step' => '0.01', 'required' => true]);
            echo $this->Form->control('stock', ['type' => 'number', 'required' => true]);
            echo $this->Form->control('size');
            echo $this->Form->control('color');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
