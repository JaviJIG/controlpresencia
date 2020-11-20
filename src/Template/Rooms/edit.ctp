<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $room->id],
                ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $room->name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Ver salas'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Buildings'), ['controller' => 'Buildings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Building'), ['controller' => 'Buildings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="rooms form large-9 medium-8 columns content">
    <?= $this->Form->create($room) ?>
    <fieldset>
        <legend><?= __('Editar sala') ?></legend>
        <div class="input select required">
            <label for="building-id">Edificio</label>
            <select name="building_id" id="building-id">
                <?php foreach ($buildings as $building) : ?>
                    <option value="<?= $building->id ?>"><?= $building->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Actualziar')) ?>
    <?= $this->Form->end() ?>
</div>
