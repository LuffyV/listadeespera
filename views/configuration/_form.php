<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'max_subject_regular')->textInput() ?>

    <?= $form->field($model, 'max_subject_extraordinary')->textInput() ?>

    <?= $form->field($model, 'instructions_before_open')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'instructions_while_open')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'instructions_after_close')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_open')->textInput() ?>

    <?= $form->field($model, 'date_close')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
