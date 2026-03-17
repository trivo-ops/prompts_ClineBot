<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="auth-container">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <h1 class="auth-title">Edit Profile</h1>
            <p class="auth-subtitle">Update your account information</p>
        </div>

        <div class="auth-flash">
            <?= $this->Flash->render() ?>
        </div>

        <?= $this->Form->create($user, ['class' => 'auth-form']) ?>

        <div class="auth-input-group">
            <?= $this->Form->label('username', 'Username', ['class' => 'auth-label']) ?>
            <?= $this->Form->text('username', [
                'class' => 'auth-input',
                'placeholder' => 'Enter your username',
                'required' => true
            ]) ?>
        </div>

        <div class="auth-input-group">
            <?= $this->Form->label('description', 'Description', ['class' => 'auth-label']) ?>
            <?= $this->Form->textarea('description', [
                'class' => 'auth-input',
                'placeholder' => 'Tell us about yourself...',
                'rows' => 4,
                'style' => 'resize: vertical;'
            ]) ?>
        </div>

        <div class="auth-input-group">
            <?= $this->Form->label('avatar_path', 'Avatar URL', ['class' => 'auth-label']) ?>
            <?= $this->Form->text('avatar_path', [
                'class' => 'auth-input',
                'placeholder' => 'https://example.com/avatar.jpg'
            ]) ?>
            <small style="color: var(--auth-text-secondary);">Enter a direct URL to your avatar image. Leave blank to use initials.</small>
        </div>

        <div style="display: flex; gap: 1rem; align-items: center;">
            <?= $this->Form->button(__('Update Profile'), [
                'class' => 'auth-submit'
            ]) ?>

            <?= $this->Html->link(__('Cancel'), ['action' => 'dashboard'], [
                'class' => 'auth-link',
                'style' => 'text-decoration: none; padding: 0.875rem 1.5rem; border: 2px solid var(--auth-input-border); border-radius: var(--auth-input-radius); background: transparent; font-weight: 700; letter-spacing: 0.025em; text-transform: uppercase; transition: all 0.2s ease;'
            ]) ?>
        </div>

        <?= $this->Form->end() ?>

        <div class="auth-nav">
            <?= $this->Html->link(__('Back to Dashboard'), ['action' => 'dashboard'], ['class' => 'auth-link']) ?>
        </div>
    </div>
</div>
