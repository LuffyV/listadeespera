<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\Registration;


/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="registration-form">

    <!-- Evita que se seleccionen más de 2 materias en el checkbox -->
    <?php $this->registerJs('
    $("[name=\'Registration[subject_id][]\']").change(function(){
        var registrationCheck = $(\':checkbox:checked\').length;
        if(registrationCheck >=2){
            $(\':checkbox:not(:checked)\').prop(\'disabled\', true);
        } else {
            $(\':checkbox:not(:checked)\').prop(\'disabled\', false);
        }
    });
    '); ?>

	<?php  
		// if(es MEyA)
		$opciones = array("Ordinario", "Extraordinario");
		// else if(es MEFI) -> $opciones = array("Curso Regular", "Acompañamiento");
	?>

    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'subject_id')->checkboxList(
        ArrayHelper::map(Subject::find()->all(), 'id', 'name'))
    ?>


    <?= $form->field($model, 'modality')->radioList($opciones) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
