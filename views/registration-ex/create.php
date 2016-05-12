<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RegistrationEx */

$this->title = Yii::t('app', 'Ex Registration');
?>
<div class="registration-ex-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelStu' => $modelStu, 
    ]) ?>

</div>
