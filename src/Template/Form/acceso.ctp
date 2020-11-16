<style>
body {
    background-color: #ECECEC
}
</style>

<div class="container-fluid" style="margin-top:2em">
    <h3 class="text-center">Control de Presencia</h3><hr/>
    <?= $this->Form->create('Form', array('action' => 'registerLog')); ?>
    <?php if (isset($roomName)): ?>
        <p><strong>Edificio: </strong><?= $buildingName ?><br>
        <strong>Sala: </strong><?= $roomName ?></p>
        <?= $this->Form->input('building_id', ['value' => $buildingId, 'type' => 'hidden']) ?>
        <?= $this->Form->input('room_id', ['value' => $roomId, 'type' => 'hidden']) ?>

    <?php else: ?>
        <p><strong>Edificio: </strong><?= $buildingName ?></p>
        <?= $this->Form->input('building_id', ['value' => $buildingId, 'type' => 'hidden']) ?>
    <?php endif; ?>
    <p id="usuario"></p>
    <hr/>
    <?= $this->Form->input('staff_id', ['type' => 'hidden']) ?>
    <div class="form-group div-codigo">
        <label for="codigo">Inserta tu código de trabajador</label>
        <input type="text" class="form-control" id="codigo" placeholder="Código" autocomplete="off"> <br>
        <div class="text-right">
            <button type="button" class="btn btn-success" id="boton-codigo">Enviar</button>
        </div>
    </div>

    <div class="form-group actividades">
        <label for="exampleFormControlSelect1">Seleccione la actividad que va a realizar</label>
        <select class="form-control" name="action_id" id="exampleFormControlSelect1">
            <?php foreach ($acciones as $key => $value): ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach ?>
        </select><br>
        <div class="text-right">            
            <input type="submit" class="btn btn-success" id="completar" value="Completar">
        </div>
    </div>



    <?= $this->Form->input('latitude', ['type' => 'hidden']) ?>
    <?= $this->Form->input('longitude', ['type' => 'hidden']) ?>
    <?= $this->Form->end() ?>

</div>

<script>
// llama la función miUbicacion cuando la página este cargada
window.onload = miUbicacion;
$('.actividades').hide();

function miUbicacion(){
    //Si los servicios de geolocalización están disponibles
    if(navigator.geolocation){
        // Para obtener la ubicación actual llama getCurrentPosition.
        navigator.geolocation.getCurrentPosition( muestraMiUbicacion );
    }else{ //de lo contrario
        alert("Los servicios de geolocalizaci\363n  no est\341n disponibles");
    }
}
function muestraMiUbicacion(posicion){
    var latitud = posicion.coords.latitude;
    var longitud = posicion.coords.longitude;
    $('#latitude').val(latitud);
    $('#longitude').val(longitud);

}

$('#boton-codigo').click(function() {
    miUbicacion();
    request = $.ajax({
        headers: {'X-CSRF-Token': <?= json_encode($csrf); ?>},
        type: "POST",
        url: '/controlpresencia/form/getStaff',
        data: {codigo:$('#codigo').val()}
    });
    request.done(function(data) {
        if(data.length > 0) {
            data = JSON.parse(data);
            console.log(data.id.toString());
            $('.div-codigo').hide();
            $('.actividades').show();
            $('#usuario').html('Bienvenid@ <strong>'+ data.nombre +' '+ data.apellidos +'</strong>');
            var id = data.id.toString();
            $('#staff-id').val(id);
        } else {
            $('#usuario').html('Por favor, introduce adecuadamente tu codigo de trabajador.');
        }

    })
    request.fail(function() {
        $('.actividades').hide();
        $('.div-codigo').show();
        $('#usuario').html('Ha habido un problema en la obtención de tus datos.');
        $('#usuario').css('color', 'red');
    })
})

</script>