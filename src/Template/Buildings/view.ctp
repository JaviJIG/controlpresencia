<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar edificio'), ['action' => 'edit', $building->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar edificio'), ['action' => 'delete', $building->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $building->name)]) ?> </li>
        <li><?= $this->Html->link(__('Ver edificios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo edificio'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="buildings view large-9 medium-8 columns content">
    <h3><?= h($building->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($building->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($building->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($building->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($building->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($building->modified) ?></td>
        </tr>
    </table>
    <div style="text-align: right">
    <?= $this->Form->create('Buildings', array('action' => 'updateUrl')) ?>
        <?= $this->Form->input('room_id', ['value' => $building->id,'type' => 'hidden']) ?>
        <?= $this->Form->submit('Actualizar URL') ?>        
    <?= $this->Form->end() ?>
    </div>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($building->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Building Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Staff Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Timestamp') ?></th>
            </tr>
            <?php foreach ($building->logs as $logs): ?>
            <tr>
                <td><?= h($logs->building_id) ?></td>
                <td><?= h($logs->room_id) ?></td>
                <td><?= h($logs->staff_id) ?></td>
                <td><?= h($logs->action_id) ?></td>
                <td><?= h($logs->timestamp) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rooms') ?></h4>
        <?php if (!empty($building->rooms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Url') ?></th>
            </tr>
            <?php foreach ($building->rooms as $rooms): ?>
            <tr>
                <td><?= h($rooms->id) ?></td>
                <td><?= h($rooms->name) ?></td>
                <td><?= h($rooms->url) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div style="text-align: center">
        <h3>Imagen QR de <?= $building->name ?></h3>
        <img src="http://chart.apis.google.com/chart?chl=https://192.168.14.38/controlpresencia/form/acceso?building=<?= $building->url ?>&cht=qr&choe=UTF-8&chs=500x500&chld=" alt="<?= $building->name ?>">
    </div>
</div>
