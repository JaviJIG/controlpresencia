<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar Log'), ['action' => 'edit', $log->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar Log'), ['action' => 'delete', $log->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $log->id)]) ?> </li>
        <li><?= $this->Html->link(__('Ver Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Log'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Buildings'), ['controller' => 'Buildings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Building'), ['controller' => 'Buildings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Staffs'), ['controller' => 'Staffs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staff'), ['controller' => 'Staffs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="logs view large-9 medium-8 columns content">
    <h3><?= h($log->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Building') ?></th>
            <td><?= $log->has('building') ? $this->Html->link($log->building->id, ['controller' => 'Buildings', 'action' => 'view', $log->building->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room') ?></th>
            <td><?= $log->has('room') ? $this->Html->link($log->room->name, ['controller' => 'Rooms', 'action' => 'view', $log->room->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff') ?></th>
            <td><?= $log->has('staff') ? $this->Html->link($log->staff->name, ['controller' => 'Staffs', 'action' => 'view', $log->staff->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $log->has('action') ? $this->Html->link($log->action->name, ['controller' => 'Actions', 'action' => 'view', $log->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timestamp') ?></th>
            <td><?= h($log->timestamp) ?></td>
        </tr>
    </table>
</div>
