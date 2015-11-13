<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Curriculum */

$this->title = Yii::t('app', 'Create Curriculum');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curriculums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
