<style>
body {
    background-color: #ECECEC
}
</style>
<?php $_POST['another'] = 'another' ?>
<div class="container error-container">
	<div class="row  d-flex align-items-center justify-content-center">
		<div class="col-md-12 text-center" style="margin-top:12em">
			<h1 class="big-text">¡Muchas gracias <?= $staffName ?> <?= $staffSurnames ?>!</h1><br>
			<h2 class="small-text">
				Tu acción ha sido <strong><?= $action ?></strong><br>
				<?php if (!empty($room)): ?>
					En la sala <strong><?= $room ?></strong> del edificio <strong><?= $building ?></strong><br>
				<?php else: ?>
					En el edificio <strong><?= $building ?></strong><br>
				<?php endif ?>
				Al día y la hora: <?= date('d-m-Y / H:i' ,strtotime($fecha)) ?>
			</h2>
            <br>
		</div>
		<!-- <div class="col-md-6  text-center">
			<p>En breves segundos serás redirigido al formulario nuevamente.</p>
		</div> -->

	</div>
</div>