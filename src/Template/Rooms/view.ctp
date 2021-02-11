<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <?php if ($userRole == 'admin') : ?>
            <li><?= $this->Html->link(__('Editar sala'), ['action' => 'edit', $room->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Eliminar sala'), ['action' => 'delete', $room->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $room->name)]) ?> </li>
            <li><?= $this->Html->link(__('Nueva sala'), ['action' => 'add']) ?> </li>
        <?php endif ?>

        <li><?= $this->Html->link(__('Ver salas'), ['action' => 'index']) ?> </li>
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
            <th scope="row"><?= __('Edificio') ?></th>
            <td><?= $room->has('building') ? $this->Html->link($room->building->name, ['controller' => 'Buildings', 'action' => 'view', $room->building->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($room->url) ?> </td>
        </tr>
    </table>
    <?php if ($userRole == 'admin') : ?>
        <div style="text-align: right">
            <?= $this->Form->create('Rooms', array('action' => 'updateUrl')) ?>
                <?= $this->Form->input('room_id', ['value' => $room->id,'type' => 'hidden']) ?>
                <?= $this->Form->submit('Actualizar URL') ?>        
            <?= $this->Form->end() ?>
        </div>
    <?php endif ?>

    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($room->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Edificio') ?></th>
                <th scope="col"><?= __('Sala') ?></th>
                <th scope="col"><?= __('Personal') ?></th>
                <th scope="col"><?= __('Accion') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Latitud') ?></th>
                <th scope="col"><?= __('Longitud') ?></th>
                <th scope="col"><?= __('Marca Tel') ?></th>
                <th scope="col"><?= __('Firmware') ?></th>
                <th scope="col"><?= __('Navegador') ?></th>


            </tr>
            <?php foreach ($room->logs as $logs): ?>
            <?php //debug($logs) ?>
            <tr>
                <td><?= h($logs->building->name) ?></td>
                <td><?= isset($logs->room->name) ? h($logs->room->name): '' ?></td>
                <td><?= h($logs->staff->name). ' ' . h($logs->staff->surnames) ?></td>
                <td><?= h($logs->action->name) ?></td>
                <td><?= h($logs->timestamp) ?></td>
                <td><?= h($logs->latitude) ?></td>
                <td><?= h($logs->longitude) ?></td>
                <td><?= h($logs->brand) ?></td>
                <td><?= h($logs->os) ?></td>
                <td><?= h($logs->navigator) ?></td>


            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div style="text-align: center">
        <h3>Imagen QR de <?= $room->name ?></h3>
        <img src="http://chart.apis.google.com/chart?chl=<?= $baseUrl ?>form/acceso?room=<?= $room->url ?>&cht=qr&choe=UTF-8&chs=500x500&chld=" alt="<?= $room->name ?>">
    </div>

</div>
