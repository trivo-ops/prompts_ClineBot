<?php
// Set the layout to use the auth layout
$this->layout = 'auth';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to your account</p>
        </div>

        <div class="auth-flash">
            <?= $this->Flash->render() ?>
        </div>

        <?= $this->Form->create(null, ['class' => 'auth-form']) ?>
            <div class="auth-input-group">
                <?= $this->Form->control('email', [
                    'required' => true,
                    'class' => 'auth-input',
                    'label' => [
                        'text' => 'Email Address',
                        'class' => 'auth-label'
                    ],
                    'placeholder' => 'Enter your email address',
                    'templates' => [
                        'inputContainer' => '<div class="auth-input-group">{{content}}</div>'
                    ]
                ]) ?>
            </div>

            <div class="auth-input-group">
                <?= $this->Form->control('password', [
                    'required' => true,
                    'class' => 'auth-input',
                    'label' => [
                        'text' => 'Password',
                        'class' => 'auth-label'
                    ],
                    'placeholder' => 'Enter your password',
                    'templates' => [
                        'inputContainer' => '<div class="auth-input-group">{{content}}</div>'
                    ]
                ]) ?>
            </div>

            <?= $this->Form->button('Login', [
                'class' => 'auth-submit'
            ]) ?>
        <?= $this->Form->end() ?>

        <div class="auth-nav">
            <p>Don't have an account?
                <?= $this->Html->link('Register here', ['action' => 'register'], [
                    'class' => 'auth-link'
                ]) ?>
            </p>
        </div>
    </div>
</div>
