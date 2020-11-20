<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Inserta tu usuario y tu contraseña') ?></legend>
        <?= $this->Form->input('username', ['label' => 'Usuario']) ?>
        <?= $this->Form->input('password', ['label' => 'Contraseña']) ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>