<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Action $action
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar acción'), ['action' => 'edit', $action->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar acción'), ['action' => 'delete', $action->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $action->name)]) ?> </li>
        <li><?= $this->Html->link(__('Ver acciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva acción'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="actions view large-9 medium-8 columns content">
    <h3><?= h($action->name) ?></h3>
    <table class="vertical-table">
    </table>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($action->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Building Id') ?></th>
                <th scope="col"><?= __('Room Id') ?></th>
                <th scope="col"><?= __('Staff Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Timestamp') ?></th>
            </tr>
            <?php foreach ($action->logs as $logs): ?>
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
</div>
