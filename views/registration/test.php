<?php 
use yii\helpers\Html;
 ?>

<div class="subject-test">
	<h2>Por favor confirma tus datos antes de enviarlos:</h2>

	<div id="alumno">
		<h3>Alumno</h3>
	</div><br>
	<div id="materiasOrdinarios">
		<h3>Materia</h3>

	</div><br>

	<div id="materiasExtraordinarios">
		<h3>Materias (extra)</h3>
	</div><br>

	<br><br>
	<?= Html::a(Yii::t('app', 'Regresar'), ['create'], ['class' => 'btn btn-danger']) ?>

	<?= Html::a(Yii::t('app', 'Aceptar'), ['test'], ['class' => 'btn btn-success']) ?>

</div>