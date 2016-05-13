<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Importations');
?>

<div class="FileImport-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data'],
		]); ?>
    

	<div class="row">
	  <div class="col-lg-6">
  	<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h4 class="panel-title">Selecciona el archivo csv:</h4>
		  </div>
		  <div class="panel-body">
    		<?= $form->field($model, 'csvFile')->fileInput() ?>
    		<div class="form-group">
					<?php echo Html::submitButton('Importar', ['class' => 'btn btn-success btn-sm', 'style' => 'float:right;']); ?>
				</div>
		  </div>
		</div>
	  </div>    
	  <div class="col-lg-6">
		<div class="panel panel-info">
			<div class="panel-heading">
		  	<h3 class="panel-title">Formato correcto para la Importación</h3>
	    </div>
		   	<div class="panel-body">
					<b>El orden de las columnas es importante.</b> 
					<li>Nombre(s)</li>
					<li>Apellidos</li>
					<li>Modelo estudiantil (MEyA=1 o MEFI=0)</li> 
					<li>Id de su carrera (Revisar "Administración" -> "Carreras")</li> 
					<li>Contraseña del usuario</li><br>
					<h4>El separador debe ser una coma</h4>
					<h3>Un ejemplo es: </h3>
					<p>12216350,Carlos Eduardo,Mena Alpuche,0,2,Enero12216350</p>
					<p>12216355,Eduardo Benjamín,Canché Vázquez,1,1,Marzo12216355</p>
		   	</div>
	  	</div>
	</div>
	  </div>    	  

	<?php echo $form->errorSummary($model); ?>

  <?php ActiveForm::end(); ?>
</div>