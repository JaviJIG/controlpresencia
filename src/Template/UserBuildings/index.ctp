<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'users','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Edificios de '.$username.':') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username', 'Usuario') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userBuildings as $userBuilding): ?>
                <?php $building = $userBuilding->building; ?>
                <tr>

                    <td><?= h($building->name) ?></td>
                    <td class="actions">
                        <?php if ($userRole == 'admin'): ?>
                                <?= $this->Form->postLink('<span class="fa fa-times" style="color: red"></span><span class="sr-only">', ['action' => 'delete', $userBuilding->id], ['escape' => false, 'alt' => 'Vincular Edificio']) ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h4>Añadir nuevo edificio a <?= $username ?></h4>
    <?= $this->Form->create('', ['url' => ['action' => 'add']]) ?>
    <fieldset>
        <input type="hidden" name="user_id" value="<?= $userId ?>">
        <div class="input select required">
            <label for="building-id">Edificio</label>
            <select name="building_id" id="building-id">
                <?php foreach ($buildings as $building) : ?>
                    <option value="<?= $building->id ?>"><?= $building->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Guardar')) ?>
    <?= $this->Form->end() ?>
</div>