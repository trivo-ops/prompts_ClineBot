<?php
// Set the layout to use the auth layout for consistent styling
$this->layout = 'auth';
?>

<div class="auth-container">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <h1 class="auth-title">Dashboard</h1>
            <p class="auth-subtitle">Welcome back, <?= h($user->username ?: $user->email) ?></p>
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
                    <span class="dashboard-value"><?= $user->created ? $user->created->i18nFormat('MMM d, yyyy') : 'Unknown' ?></span>
                </div>
            </div>

            <div class="dashboard-actions">
                <?= $this->Html->link(
                    'View Products Management',
                    '/products',
                    ['class' => 'auth-submit']
                ) ?>

                <?= $this->Form->postLink(
                    'Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    [
                        'class' => 'auth-submit',
                        'confirm' => 'Are you sure you want to logout?'
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>
