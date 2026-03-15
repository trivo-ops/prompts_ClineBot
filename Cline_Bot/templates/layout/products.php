<?php
/**
 * Products Layout - Modern styling consistent with auth pages
 *
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= h($this->fetch('title') ?: 'Products Management') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Base CSS -->
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <!-- Auth CSS for consistent styling -->
    <?= $this->Html->css('auth') ?>

    <!-- Products-specific CSS -->
    <?= $this->Html->css('products') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Products</span> Management</a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link('Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'nav-link']) ?>
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
        </div>
    </nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> Products Management System</p>
        </div>
    </footer>
</body>
</html>
