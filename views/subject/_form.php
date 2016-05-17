<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-form">

    <?php 
        $modelos_educativos = array("MEFI", "MEyA", "Ambos");
        $disponibilidad = array("No", "Sí");
     ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'schedule')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classroom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'educational_model')->radioList($modelos_educativos) ?>

    <?= $form->field($model, 'available')->radioList($disponibilidad) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
