<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Register</h3>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true, 'type' => 'password']) ?>
    </fieldset>
    <?= $this->Form->button('Register') ?>
    <?= $this->Form->end() ?>

    <p>Already have an account? <?= $this->Html->link('Login here', ['action' => 'login']) ?></p>
</div>
