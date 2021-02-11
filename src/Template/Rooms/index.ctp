<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room[]|\Cake\Collection\CollectionInterface $rooms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <?php if ($userRole == 'admin'): ?>
            <li><?= $this->Html->link(__('Nueva Sala'), ['action' => 'add']) ?></li>
        <?php endif ?>
        <!-- <li><?= $this->Html->link(__('List Buildings'), ['controller' => 'Buildings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Building'), ['controller' => 'Buildings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="rooms index large-9 medium-8 columns content">
    <h3><?= __('Salas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('building_id', 'Edificio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= h($room->name) ?></td>
                <td><?= $room->has('building') ? $this->Html->link($room->building->name, ['controller' => 'Buildings', 'action' => 'view', $room->building->id]) : '' ?></td>
                <td><?= h($room->url) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="fa fa-eye"></span><span class="sr-only">' . __('Ver') . '</span>', ['action' => 'view', $room->id], ['escape' => false]) ?>
                    <?php if ($userRole == 'admin'): ?>
                        <?= $this->Html->link('<span class="fa fa-pen"></span><span class="sr-only">' . __('Editar') . '</span>', ['action' => 'edit', $room->id], ['escape' => false]) ?>
                        <?= $this->Form->postLink('<span class="fa fa-trash"></span><span class="sr-only">' . __('Eliminar') . '</span>', ['action' => 'delete', $room->id], ['escape' => false, 'confirm' => __('¿Está seguro de que desea eliminar {0}?', $room->name)]) ?>
                    <?php endif ?>
                </td>
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
