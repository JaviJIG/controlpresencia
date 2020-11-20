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
    <h3><?= h($building->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($building->url) ?></td>
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
            <?php foreach ($building->logs as $logs): ?>
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
    <!-- <div class="related">
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
    </div> -->
    <div style="text-align: center">
        <h3>Imagen QR de <?= $building->name ?></h3>
        <img src="http://chart.apis.google.com/chart?chl=<?= $baseUrl ?>form/acceso?building=<?= $building->url ?>&cht=qr&choe=UTF-8&chs=500x500&chld=" alt="<?= $building->name ?>">
    </div>
</div>
