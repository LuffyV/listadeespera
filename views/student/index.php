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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Student'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                    if($dataProvider['model'] == '2') return 'Ambos';
                }
            ],
            // 'curriculum_id',
            [
                'attribute' => 'curriculum_id',
                'label' => 'Educational Model',
                'value' => function($dataProvider){
                    if($dataProvider['curriculum_id'] == '0') return 'LIS';
                    if($dataProvider['curriculum_id'] == '1') return 'LIC';
                    if($dataProvider['curriculum_id'] == '2') return 'LCC';
                    if($dataProvider['curriculum_id'] == '3') return 'LA';
                    if($dataProvider['curriculum_id'] == '4') return 'LEM';
                    if($dataProvider['curriculum_id'] == '5') return 'LM';
                }
            ],
            'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
