<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Action $action
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $action->id],
                ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $action->name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Ver acciones'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="actions form large-9 medium-8 columns content">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <legend><?= __('Editar Acción') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Actualizar')) ?>
    <?= $this->Form->end() ?>
</div>
