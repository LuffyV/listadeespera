<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Reports');
$this->params['breadcrumbs'][] = Yii::t('app', 'Reports');
$items = ['Materias', 'Estudiantes', 'Registros'];
?>

<div class="reports-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'tipo')->inline()->radioList($items);?>
    <?= $form->field($model, 'titulo') ?>

    <p class="form-group">
        <?= Html::submitButton('Exportar', ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>