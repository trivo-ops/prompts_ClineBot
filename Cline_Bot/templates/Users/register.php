<?php
// Set the layout to use the auth layout
$this->layout = 'auth';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join us today</p>
        </div>

        <div class="auth-flash">
            <?= $this->Flash->render() ?>
        </div>

        <?= $this->Form->create($user, ['class' => 'auth-form']) ?>
            <div class="auth-input-group">
                <?= $this->Form->control('username', [
                    'required' => true,
                    'class' => 'auth-input',
                    'label' => [
                        'text' => 'Username',
                        'class' => 'auth-label'
                    ],
                    'placeholder' => 'Choose a username',
                    'templates' => [
                        'inputContainer' => '<div class="auth-input-group">{{content}}</div>'
                    ]
                ]) ?>
            </div>

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
                    'type' => 'password',
                    'class' => 'auth-input',
                    'label' => [
                        'text' => 'Password',
                        'class' => 'auth-label'
                    ],
                    'placeholder' => 'Create a strong password',
                    'templates' => [
                        'inputContainer' => '<div class="auth-input-group">{{content}}</div>'
                    ]
                ]) ?>
            </div>

            <?= $this->Form->button('Register', [
                'class' => 'auth-submit'
            ]) ?>
        <?= $this->Form->end() ?>

        <div class="auth-nav">
            <p>Already have an account?
                <?= $this->Html->link('Login here', ['action' => 'login'], [
                    'class' => 'auth-link'
                ]) ?>
            </p>
        </div>
    </div>
</div>
