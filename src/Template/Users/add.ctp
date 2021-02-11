<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Añadir nuevo usuario (GESTOR)') ?></legend>
        <div class="large-4 medium-4 columns">
            <?= $this->Form->input('username', ['label' => 'Usuario']) ?>
        </div>
        <div class="large-4 medium-4 columns">
            <?= $this->Form->input('password', ['label' => 'Contraseña']) ?>
        </div>
        <div class="large-4 medium-4 columns">
            <?= $this->Form->input('role', ['label' => 'Rol',
                'options' => [
                    'admin' =>  'Admin',
                    'user'  =>  'User'
                    ]
            ]) ?>
        </div>
        <div class="large-12 medium-12 columns">
            <?= $this->Form->button(__('Registrar')); ?>
        </div>
   </fieldset>
<?= $this->Form->end() ?>
</div>