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
    
  	<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h4 class="panel-title">Selecciona el archivo csv:</h4>
		  </div>
		  <div class="panel-body">
    		<?= $form->field($model, 'csvFile')->fileInput() ?>
    		<div class="form-group">
					<?php echo Html::submitButton('Importar', ['class' => 'btn btn-success btn-sm']); ?>
				</div>
		  </div>
		</div>

	<?php echo $form->errorSummary($model); ?>

  <?php ActiveForm::end(); ?>
</div>