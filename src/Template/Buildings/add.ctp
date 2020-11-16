<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Ver edificios'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="buildings form large-9 medium-8 columns content">
    <?= $this->Form->create($building) ?>
    <fieldset>
        <legend><?= __('Add Building') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
