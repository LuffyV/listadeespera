<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use letyii\tinymce\TinyMce;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Configuration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'max_subject_regular')->textInput() ?>

    <?= $form->field($model, 'max_subject_extraordinary')->textInput() ?>

    <?= $form->field($model, 'instructions_before_open')->widget(letyii\tinymce\Tinymce::className(), [
            'options' => ['id' => 'testid']]); ?>

    <?= $form->field($model, 'instructions_while_open')->widget(letyii\tinymce\Tinymce::className(), [
            'options' => ['id' => 'testid']]); ?>

    <?= $form->field($model, 'instructions_after_close')->widget(letyii\tinymce\Tinymce::className(), [
            'options' => ['id' => 'testid']]); ?>

    <?= $form->field($model, 'date_open')->widget(DateTimePicker::classname(), [
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose'=>true,
        ]
    ]); ?>

    <?= $form->field($model, 'date_close')->widget(DateTimePicker::classname(), [
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose'=>true,
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
