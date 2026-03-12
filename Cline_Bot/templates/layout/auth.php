<?php
/**
 * Auth Layout - Clean authentication pages without CakePHP header/navigation
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Load auth-specific CSS -->
    <?= $this->Html->css('auth') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- No header/navigation - clean auth page layout -->
    <main class="auth-main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
</body>
</html>
