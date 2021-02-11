<!-- <div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Inserta tu usuario y tu contraseña') ?></legend>
            <?= $this->Form->input('username', ['label' => 'Usuario']) ?>
            <?= $this->Form->input('password', ['label' => 'Contraseña']) ?>
            <?= $this->Form->button(__('Login')); ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div> -->


<div class="large-4 medium-2 columns" style="width: 30%; color:white;">a</div>

<div class="large-4 medium-8 columns" style="width: 30%;">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Inserta tu usuario y tu contraseña') ?></legend>
            <?= $this->Form->input('username', ['label' => 'Usuario']) ?>
            <?= $this->Form->input('password', ['label' => 'Contraseña']) ?>
            <div style="text-align: center;">
                <?= $this->Form->button(__('Login'), ['style' => 'background-color: #00A903; border-radius: 5px;']); ?>
            </div>
        </fieldset>
    <?= $this->Form->end() ?>
</div>

<div class="large-4 medium-2 columns" style="width: 30%; color:white;">a</div>
