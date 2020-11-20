<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar personal'), ['action' => 'edit', $staff->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar personal'), ['action' => 'delete', $staff->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $staff->name.' '.$staff->surnames)]) ?> </li>
        <li><?= $this->Html->link(__('Ver personal'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo personal'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="staffs view large-9 medium-8 columns content">
    <h3><?= h($staff->name). ' '. h($staff->surnames) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Codigo trabajador') ?></th>
            <td><?= h($staff->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correo electrónico') ?></th>
            <td><?= h($staff->email) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($staff->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Edificio') ?></th>
                <th scope="col"><?= __('Sala') ?></th>
                <th scope="col"><?= __('Acción') ?></th>
                <th scope="col"><?= __('Hora Log') ?></th>
                <th scope="col"><?= __('Latitud') ?></th>
                <th scope="col"><?= __('Longitud') ?></th>
            </tr>
            <?php foreach ($staff->logs as $logs): ?>
            <tr>
                <td><?= h($logs->building->name) ?></td>
                <td><?= isset($logs->room->name) ? $logs->room->name: '' ?></td>
                <td><?= h($logs->action->name) ?></td>
                <td><?= $logs->timestamp->i18nFormat('dd-MM-YYYY HH:mm') ?></td>
                <td><?= h($logs->latitude) ?></td>
                <td><?= h($logs->longitude) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
