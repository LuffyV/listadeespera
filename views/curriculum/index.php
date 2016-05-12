<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurriculumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Curriculums');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-index">

    <h1 style="display: inline-block;"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="display: inline-block; margin-left: 2em;">
        <?= Html::a(Yii::t('app', 'Create Curriculum'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'short_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
