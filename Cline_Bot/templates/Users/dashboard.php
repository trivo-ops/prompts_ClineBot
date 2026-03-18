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
            <div class="dashboard-profile">
                <div class="profile-avatar">
                    <?php if (!empty($user->avatar_path)): ?>
                        <img src="<?= h($user->avatar_path) ?>" alt="Avatar" class="avatar-image">
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <span class="avatar-initials"><?= strtoupper(substr($user->username ?: $user->email, 0, 2)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="profile-info">
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
                            <span class="dashboard-label">Member since created</span>
                            <span class="dashboard-value"><?= $user->created ? $user->created->i18nFormat('MMM d, yyyy') : 'Unknown' ?></span>
                        </div>

                       <?php if (!empty($user->description)): ?>
                           <div class="dashboard-item">
                               <span class="dashboard-label">About</span>
                               <span class="dashboard-value"><?= h($user->description) ?></span>
                           </div>
                       <?php endif; ?>
                    </div>
                </div>
            </div>

        <div class="dashboard-actions">
            <?= $this->Html->link(__('Edit Profile'), ['action' => 'edit'], [
                'class' => 'auth-link',
                'style' => 'display: inline-block; padding: 0.75rem 1.5rem; border: 2px solid var(--auth-input-border); border-radius: var(--auth-input-radius); background: transparent; color: var(--auth-input-text); font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase; transition: all 0.2s ease; text-decoration: none;'
            ]) ?>

            <?= $this->Html->link(__('Manage Products'), ['controller' => 'Products', 'action' => 'index'], [
                'class' => 'auth-link',
                'style' => 'display: inline-block; padding: 0.75rem 1.5rem; border: 2px solid var(--auth-input-border); border-radius: var(--auth-input-radius); background: transparent; color: var(--auth-input-text); font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase; transition: all 0.2s ease; text-decoration: none;'
            ]) ?>

            <?= $this->Html->link(__('Manage Categories'), ['controller' => 'Categories', 'action' => 'index'], [
                'class' => 'auth-link',
                'style' => 'display: inline-block; padding: 0.75rem 1.5rem; border: 2px solid var(--auth-input-border); border-radius: var(--auth-input-radius); background: transparent; color: var(--auth-input-text); font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase; transition: all 0.2s ease; text-decoration: none;'
            ]) ?>

            <?= $this->Html->link(__('Logout'), ['action' => 'logout'], [
                'class' => 'auth-link',
                'style' => 'display: inline-block; padding: 0.75rem 1.5rem; border: 2px solid var(--auth-input-border); border-radius: var(--auth-input-radius); background: transparent; color: var(--auth-input-text); font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase; transition: all 0.2s ease; text-decoration: none;'
            ]) ?>
        </div>
        </div>
    </div>
</div>
