<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Buildings'), ['controller' => 'Buildings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Building'), ['controller' => 'Buildings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Staffs'), ['controller' => 'Staffs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Staff'), ['controller' => 'Staffs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav> -->

<div class="logs index large-12 medium-12 columns content">
    <h3><?= __('Logs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('building_id', 'Edificio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('room_id', 'Sala') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff_id', 'Personal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id', 'Accion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude', 'Latitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitude', 'Longitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timestamp', 'Hora Accion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand', 'Tel. Marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('os', 'Firmware') ?></th>
                <th scope="col"><?= $this->Paginator->sort('navigator', 'Navegador') ?></th>
                <?php if ($userRole == 'admin'): ?>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->has('building') ? $this->Html->link($log->building->name, ['controller' => 'Buildings', 'action' => 'view', $log->building->id]) : '' ?></td>
                <td><?= $log->has('room') ? $this->Html->link($log->room->name, ['controller' => 'Rooms', 'action' => 'view', $log->room->id]) : '' ?></td>
                <td><?= $log->has('staff') ? $this->Html->link($log->staff->name, ['controller' => 'Staffs', 'action' => 'view', $log->staff->id]) : '' ?></td>
                <td><?= $log->has('action') ? $this->Html->link($log->action->name, ['controller' => 'Actions', 'action' => 'view', $log->action->id]) : '' ?></td>
                <td><?= h($log->latitude) ?></td>
                <td><?= h($log->longitude) ?></td>
                <td><?= h($log->timestamp->i18nFormat('dd-MM-YYYY')) ?><br><?= h($log->timestamp->i18nFormat('HH:mm')) ?></td>
                <td><?= h($log->brand) ?></td>
                <td><?= h($log->os) ?></td>
                <td><?= h($log->navigator) ?></td>
                <?php if ($userRole == 'admin'):  ?>
                    <td class="actions">
                        <?= $this->Html->link('<span class="fa fa-eye"></span><span class="sr-only">' . __('Ver') . '</span>', ['action' => 'view', $log->id], ['escape' => false]) ?>
                        <?= $this->Html->link('<span class="fa fa-pen"></span><span class="sr-only">' . __('Editar') . '</span>', ['action' => 'edit', $log->id], ['escape' => false]) ?>
                        <?= $this->Form->postLink('<span class="fa fa-trash"></span><span class="sr-only">' . __('Eliminar') . '</span>', ['action' => 'delete', $log->id], ['escape' => false, 'confirm' => __('¿Está seguro de que desea eliminar {0}?', $log->id)]) ?>
                    </td>
                <?php endif ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primera')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('última') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, viendo {{current}} de las {{count}}')]) ?></p>
    </div>
</div>

