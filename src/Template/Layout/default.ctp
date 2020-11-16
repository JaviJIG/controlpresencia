<?php
$cakeDescription = 'Control de Presencia';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?=$this->Html->meta('persona-icono.png','/img/persona-icono.png',['type' => 'icon']); ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="">Control de Presencia
                <!-- <?= $this->fetch('title') ?> -->
                </a></h1>
            </li>
        </ul>
        <?php if (isset($userName)): ?>
            <div class="top-bar-section">
                <ul class="right">
                    <li><?= $this->Html->Link('Edificios', ['controller' => 'buildings']) ?></li>
                    <li><?= $this->Html->Link('Salas', ['controller' => 'rooms']) ?></li>
                    <li><?= $this->Html->Link('Personal', ['controller' => 'staffs']) ?></li>
                    <li><?= $this->Html->Link('Acciones', ['controller' => 'actions']) ?></li>
                    <li><?= $this->Html->Link('Logs', ['controller' => 'logs']) ?></li>
                    <li><?= $this->Html->Link('Añadir admin', ['controller' => 'users', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->Link('Salir', ['controller' => 'users', 'action' => 'logout']) ?></li>
                </ul>
            </div>
        <?php endif ?>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container container-fluid clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
