<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->button('Login') ?>
    <?= $this->Form->end() ?>

    <p>Don't have an account? <?= $this->Html->link('Register here', ['action' => 'register']) ?></p>
</div>
