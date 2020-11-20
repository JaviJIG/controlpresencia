<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $staff->id],
                ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $staff->name.' '.$staff->surnames)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Ver personal'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="staffs form large-9 medium-8 columns content">
    <?= $this->Form->create($staff) ?>
    <fieldset>
        <legend><?= __('Editar Personal') ?></legend>
        <?php
            echo $this->Form->control('code', ['label' => 'Código']);
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('surnames', ['label' => 'Apellidos']);
            echo $this->Form->control('email', ['label' => 'Correo electrónico']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Actualziar')) ?>
    <?= $this->Form->end() ?>
</div>
