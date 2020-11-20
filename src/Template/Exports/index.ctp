<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Form->create('Export', ['url' => ['action' => 'index']]) ?>
<div class="exports form large-12 columns content">
    <h3><?= __('Exportar a excel') ?></h3>

    <div class="large-3 columns content">
        <label for="building-id">Edificio</label>
        <select name="building_id" id="building-id">
            <option value="">Seleccione edificio</option>
            <?php foreach ($buildings as $building) : ?>
                <option value="<?= $building->id ?>"><?= $building->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="large-3 columns content">
        <label for="room-id">Sala</label>
        <select name="room_id" id="room-id">
            <option value="">Seleccione un edificio</option>
        </select>
    </div>
    <div class="large-3 columns content">
        <label for="staff-id">Empleado</label>
        <select name="staff_id" id="staff-id">
            <option value="">Seleccione empleado</option>
            <?php foreach ($staffs as $staff) : ?>
                <option value="<?= $staff->id ?>"><?= $staff->name ?> <?= $staff->surnames ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="large-3 columns content">
        <label for="fecha-ini">Fecha inicio</label>
        <input type="text" class="datepicker" name="fecha_ini" id="fecha-ini" autocomplete='off'>
        <label for="fecha-fin">Fecha fin</label>
        <input type="text" class="datepicker" name="fecha_fin" id="fecha-fin" autocomplete='off'>
    </div>
</div>
<div class="large-5 columns content"></div>
<div class="large-2 columns content" style="text-align:center">
    <?= $this->Form->button(__('Exportar')) ?>
</div>
<div class="large-5 columns content"></div>
<?= $this->Form->end() ?>



<script>
$('.datepicker').datepicker({
    todayBtn: "linked",
    language: "es",
    autoclose: true,
    todayHighlight: true,
    dateFormat: 'dd/mm/yy' 
});

$('#building-id').change(function() {
    $('#room-id').empty().append('whatever');
    var url = "<?php echo $ajaxUrl ?>"
    request = $.ajax({
        headers: {'X-CSRF-Token': <?= json_encode($csrf); ?>},
        type: "POST",
        url: url + 'exports/getRooms',
        data: {building_id:$('#building-id').val()}
    });
    request.done(function(data) {
        var o = new Option('Seleccione sala', '');
        $(o).html('Seleccione sala');
        $("#room-id").append(o);
        data = JSON.parse(data)
        for (let index = 0; index < data.length; index++) {
            var room = data[index];
            var o = new Option(room.name, room.id);
            $(o).html(room.name);
            $("#room-id").append(o);
        }
    })
    request.fail(function() {
        var o = new Option('Seleccione sala', '');
        $(o).html('Seleccione sala');
        $("#room-id").append(o);
    })
});
</script>