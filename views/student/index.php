<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="student-index">
    <h1 style="display: inline-block;"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="display: inline-block; margin-left: 2em;">
        <?= Html::a(Yii::t('app', 'Create Student'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Import'), ['import'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php 
        $carreras = (new \yii\db\Query())
            ->select(['short_name'])
            ->from('curriculum')
            ->all();
     ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'first_name',
            'last_name',
            'student_id',
            // 'model',
            [
                'attribute' => 'model',
                'label' => 'Educational Model',
                'value' => function($dataProvider){
                    if($dataProvider['model'] == '0') return 'MEFI';
                    if($dataProvider['model'] == '1') return 'MEyA';
                }
            ],
            // 'curriculum_id',
            [
                'attribute' => 'curriculum_id',
                'label' => 'Curriculum',
                'value' => 'curriculum.short_name',
            ],
            'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
