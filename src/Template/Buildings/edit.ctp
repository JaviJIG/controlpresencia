<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $building->id],
                ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $building->name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Ver edificios'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="buildings form large-9 medium-8 columns content">
    <?= $this->Form->create($building) ?>
    <fieldset>
        <legend><?= __('Editar edificio') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Actualizar')) ?>
    <?= $this->Form->end() ?>
</div>
