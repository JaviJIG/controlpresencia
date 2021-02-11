<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Building $building
 */
if (!isset($building)) {
    $building = $logs->first()->building;
}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <?php if ($userRole == 'admin'): ?>
            <li><?= $this->Html->link(__('Editar edificio'), ['action' => 'edit', $building->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Eliminar edificio'), ['action' => 'delete', $building->id], ['confirm' => __('¿Está seguro de que desea eliminar {0}?', $building->name)]) ?> </li>
            <li><?= $this->Html->link(__('Nuevo edificio'), ['action' => 'add']) ?> </li>
        <?php endif; ?>

        <li><?= $this->Html->link(__('Ver edificios'), ['action' => 'index']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li> -->
        <!-- <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="buildings view large-9 medium-8 columns content">
    <h3><?= h($building->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($building->url) ?></td>
        </tr>
    </table>
    <?php if ($userRole == 'admin'): ?>
        <div style="text-align: right">
            <?= $this->Form->create('Buildings', array('action' => 'updateUrl')) ?>
                <?= $this->Form->input('room_id', ['value' => $building->id,'type' => 'hidden']) ?>
                <?= $this->Form->submit('Actualizar URL') ?>        
            <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>

    <div class="related">
        <h4><?= __('Logs relacionados a '. $building->name) ?></h4>
        <?php //debug($staffs) ?>
        <?= $this->Form->create('', ['url' => ['action' => 'view', $building->id]]) ?>
            <div class="large-3 medium-3 columns">
                <div class="input select">
                    <label for="staff-id">Personal</label>
                    <select name="staff_id" id="staff-id">
                        <option value="">Elige personal</option>
                        <?php foreach ($staffs as $staff) : ?>
                            <option value="<?= $staff->id ?>"><?= $staff->name.' '.$staff->surnames ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="large-3 medium-3 columns">
                <div class="input select">
                    <label for="action-id">Acción</label>
                    <select name="action_id" id="action-id">
                        <option value="">Elige acción</option>
                        <?php foreach ($actions as $action) : ?>
                            <option value="<?= $action->id ?>"><?= $action->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="large-3 medium-3 columns">
                <div class="input select">
                    <label for="fecha-inicio">Fecha inicio</label>
                    <input type="text" class="form_datetime" name="fecha_inicio" id="fecha-inicio" autocomplete="off" readonly>
                </div>
            </div>
            <div class="large-3 medium-3 columns">
                <div class="input select">
                <label for="fecha-fin">Fecha inicio</label>
                    <input type="text" class="form_datetime" name="fecha_fin" id="fecha-fin" autocomplete="off" readonly>
                </div>
            </div>
            <div class="columns" style="text-align:right">
                <button type="submit">Cargar</button>
            </div>
        <?= $this->Form->end() ?>
        <?php if (!empty($logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <!-- <th scope="col"><?= __('Edificio') ?></th> -->
                <th scope="col"><?= __('Sala') ?></th>
                <th scope="col"><?= __('Personal') ?></th>
                <th scope="col"><?= __('Accion') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Latitud') ?></th>
                <th scope="col"><?= __('Longitud') ?></th>
                <th scope="col"><?= __('Marca Tel') ?></th>
                <th scope="col"><?= __('Firmware') ?></th>
                <th scope="col"><?= __('Navegador') ?></th>


            </tr>
            <?php foreach ($logs as $logs): ?>
            <?php //debug($logs) ?>
            <tr>
                <!-- <td><?= h($logs->building->name) ?></td> -->
                <td><?= isset($logs->room->name) ? h($logs->room->name): '' ?></td>
                <td><?= h($logs->staff->name). ' ' . h($logs->staff->surnames) ?></td>
                <td><?= h($logs->action->name) ?></td>
                <td><?= h($logs->timestamp->i18nFormat('dd-MM-YYYY HH:mm')) ?></td>
                <td><?= h($logs->latitude) ?></td>
                <td><?= h($logs->longitude) ?></td>
                <td><?= h($logs->brand) ?></td>
                <td><?= h($logs->os) ?></td>
                <td><?= h($logs->navigator) ?></td>


            </tr>
            <?php endforeach; ?>
        </table>
        <?php $_SESSION['Building']['Filters'][$building->id] = $filtros; ?>
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
        <?php endif; ?>
    </div>
    <div style="text-align: center">
        <h3>Imagen QR de <?= $building->name ?></h3>
        <img src="http://chart.apis.google.com/chart?chl=<?= $baseUrl ?>form/acceso?building=<?= $building->url ?>&cht=qr&choe=UTF-8&chs=500x500&chld=" alt="<?= $building->name ?>">
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        'use strict';

        jQuery('.form_datetime').datetimepicker({
            i18n:{
                de:{
                    months:[
                        'Enero','Febrero','Marzo','Abril',
                        'Mayo','Junio','Julio','Agosto',
                        'Septiembre','Octubre','Noviembre','Diciembre',
                    ],
                    dayOfWeek:[
                        "Do.", "Lu", "Ma", "Mi", 
                        "Ju", "Vi", "Sa.",
                    ]
                }
            },
            timepicker:false,
            format:'d/m/Y',
            theme:'dark'
        });
    });
</script>  
