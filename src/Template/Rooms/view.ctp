<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar sala'), ['action' => 'edit', $room->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar sala'), ['action' => 'delete', $room->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $room->name)]) ?> </li>
        <li><?= $this->Html->link(__('Ver salas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva sala'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Buildings'), ['controller' => 'Buildings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Building'), ['controller' => 'Buildings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="rooms view large-9 medium-8 columns content">
    <h3><?= h($room->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Building') ?></th>
            <td><?= $room->has('building') ? $this->Html->link($room->building->id, ['controller' => 'Buildings', 'action' => 'view', $room->building->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($room->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($room->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($room->id) ?></td>
        </tr>
    </table>
    <div style="text-align: right">
    <?= $this->Form->create('Rooms', array('action' => 'updateUrl')) ?>
        <?= $this->Form->input('room_id', ['value' => $room->id,'type' => 'hidden']) ?>
        <?= $this->Form->submit('Actualizar URL') ?>        
    <?= $this->Form->end() ?>
    </div>

    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($room->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Building Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Staff Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Timestamp') ?></th>
            </tr>
            <?php foreach ($room->logs as $logs): ?>
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
    <div style="text-align: center">
        <h3>Imagen QR de <?= $room->name ?></h3>
        <img src="http://chart.apis.google.com/chart?chl=https://192.168.14.38/controlpresencia/form/acceso?room=<?= $room->url ?>&cht=qr&choe=UTF-8&chs=500x500&chld=" alt="<?= $room->name ?>">
    </div>

</div>
