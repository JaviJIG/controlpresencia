<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff[]|\Cake\Collection\CollectionInterface $staffs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo personal'), ['action' => 'add']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="staffs index large-9 medium-8 columns content">
    <h3><?= __('Personal') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surnames', 'Apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code', 'Código') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff): ?>
            <tr>
                <td><?= h($staff->name) ?></td>
                <td><?= h($staff->surnames) ?></td>
                <td><?= h($staff->code) ?></td>
                <td><?= h($staff->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="fa fa-eye"></span><span class="sr-only">' . __('Ver') . '</span>', ['action' => 'view', $staff->id], ['escape' => false]) ?>
                    <?php if ($userRole == 'admin'): ?>
                        <?= $this->Html->link('<span class="fa fa-pen"></span><span class="sr-only">' . __('Editar') . '</span>', ['action' => 'edit', $staff->id], ['escape' => false]) ?>
                        <?= $this->Form->postLink('<span class="fa fa-trash"></span><span class="sr-only">' . __('Eliminar') . '</span>', ['action' => 'delete', $staff->id], ['escape' => false, 'confirm' => __('¿Está seguro de que desea eliminar {0}?', $staff->name.' '.$staff->surnames)]) ?>
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
