<?php
/**
 * @var \App\View\AppView $this
 * @var \Authentication\IdentityInterface $user
 */
?>

<div class="auth-page">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <h1>Dashboard</h1>
            <p>Welcome back, <?= h($user->username ?: $user->email) ?></p>
        </div>

        <div class="auth-content">
            <div class="dashboard-summary">
                <div class="dashboard-item">
                    <span class="dashboard-label">Username</span>
                    <span class="dashboard-value"><?= h($user->username) ?></span>
                </div>

                <div class="dashboard-item">
                    <span class="dashboard-label">Email</span>
                    <span class="dashboard-value"><?= h($user->email) ?></span>
                </div>

                <div class="dashboard-item">
                    <span class="dashboard-label">Member since</span>
                    <span class="dashboard-value"><?= h($user->created) ?></span>
                </div>
            </div>

            <div class="dashboard-actions">
                <?= $this->Html->link(
                    'View Products',
                    '/products',
                    ['class' => 'auth-button auth-button-secondary']
                ) ?>

                <?= $this->Html->link(
                    'Add Product',
                    '/products/add',
                    ['class' => 'auth-button auth-button-secondary']
                ) ?>

                <?= $this->Form->postLink(
                    'Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    [
                        'class' => 'auth-button',
                        'confirm' => 'Are you sure you want to logout?'
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>
