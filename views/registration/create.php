<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $model app\models\RegistrationEx */

$this->title = Yii::t('app', 'Registration');
?>
<div class="registration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelEx' => $modelEx,
        'modelStu' => $modelStu, 
    ]) ?>
</div>
