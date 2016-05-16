<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subjects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <h1 style="display: inline-block;"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="display: inline-block; margin-left: 2em;">
        <?= Html::a(Yii::t('app', 'Create Subject'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'name',
            'teacher',
            'schedule',
            'classroom',
            // 'educational_model',
            [
                'attribute' => 'educational_model',
                'label' => Yii::t('app', 'Educational Model'),
                'value' => function($dataProvider){
                    if($dataProvider['educational_model'] == '0') return 'MEFI';
                    if($dataProvider['educational_model'] == '1') return 'MEyA';
                    if($dataProvider['educational_model'] == '2') return 'Ambos';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
