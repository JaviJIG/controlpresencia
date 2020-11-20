<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Añadir nuevo usuario (GESTOR)') ?></legend>
        <?= $this->Form->input('username', ['label' => 'Usuario']) ?>
        <?= $this->Form->input('password', ['label' => 'Contraseña']) ?>
        <!-- <?= $this->Form->input('role', [
            'options' => ['admin' => 'Admin']
        ]) ?> -->
   </fieldset>
<?= $this->Form->button(__('Registrar')); ?>
<?= $this->Form->end() ?>
</div>