<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Curriculum;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php 
        $modelos_educativos = array("MEFI", "MEyA", "Ambos");
     ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->radioList($modelos_educativos) ?>

    <?= $form->field($model, 'curriculum_id')->radioList(
        ArrayHelper::map(Curriculum::find()->all(), 'id', 'name'))
    ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
