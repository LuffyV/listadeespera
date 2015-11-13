<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConfigurationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'max_subject_regular') ?>

    <?= $form->field($model, 'max_subject_extraordinary') ?>

    <?= $form->field($model, 'instructions_before_open') ?>

    <?= $form->field($model, 'instructions_while_open') ?>

    <?php // echo $form->field($model, 'instructions_after_close') ?>

    <?php // echo $form->field($model, 'date_open') ?>

    <?php // echo $form->field($model, 'date_close') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
