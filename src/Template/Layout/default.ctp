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
    <?= $this->Html->css('jquery.datetimepicker') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <?= $this->Html->script('jquery.datetimepicker.full.min') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="">
                </a>
                <?= $this->Html->link('Control de Presencia', ['action' => 'index']) ?>
            </h1>
            </li>
        </ul>
        <?php if (isset($userName)): ?>
            <div class="top-bar-section">
                <ul class="right">
                    <?php if ($userRole == 'admin'): ?>
                        <li><?= $this->Html->Link('Edificios', ['controller' => 'buildings']) ?></li>
                        <li><?= $this->Html->Link('Salas', ['controller' => 'rooms']) ?></li>
                        <li><?= $this->Html->Link('Personal', ['controller' => 'staffs']) ?></li>
                        <li><?= $this->Html->Link('Acciones', ['controller' => 'actions']) ?></li>
                        <li><?= $this->Html->Link('Logs', ['controller' => 'logs']) ?></li>
                        <li><?= $this->Html->Link('Exportar', ['controller' => 'exports']) ?></li>
                        <li><?= $this->Html->Link('Usuarios', ['controller' => 'users']) ?></li>
                        <li><?= $this->Html->Link('Salir', ['controller' => 'users', 'action' => 'logout']) ?></li>
                    <?php endif; ?>
                    <?php if ($userRole == 'user'): ?>
                        <li><?= $this->Html->Link('Edificios', ['controller' => 'buildings']) ?></li>
                        <li><?= $this->Html->Link('Salas', ['controller' => 'rooms']) ?></li>
                        <li><?= $this->Html->Link('Logs', ['controller' => 'logs']) ?></li>
                        <li><?= $this->Html->Link('Salir', ['controller' => 'users', 'action' => 'logout']) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif ?>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container container-fluid clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <footer style="background-color: #444849; color: white;">
        <div style="text-align:center; padding-top: 1em; padding-bottom:1em;">
            &copy; <a href="https://www.jig.es/" style="color:white">JIG</a>
        </div>
    </footer>
</body>
</html>
