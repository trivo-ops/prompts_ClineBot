<div class="users view content">
    <h3>Welcome, <?= h($user->username) ?></h3>
    <p>Email: <?= h($user->email) ?></p>
    <p>Member since: <?= h($user->created) ?></p>

    <div class="actions">
        <?= $this->Form->postLink(
            'Logout',
            ['action' => 'logout'],
            ['confirm' => 'Are you sure you want to logout?']
        ) ?>
    </div>
</div>
