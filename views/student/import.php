<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="FileImport-form">
    <?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data'],
	]); ?>
    
    <h4>Selecciona el csv: </h4>
    
    <?= $form->field($model, 'csvFile')->fileInput() ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo Html::submitButton('Importar'); ?>
	</div>

    <?php ActiveForm::end(); ?>
</div>