<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registrations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Registration'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'subject_id',
                'label' => 'Subjects',
                'value' => 'subject.name',
            ],
            [
                'attribute' => 'teacher',
                'label' => 'Teacher',
                'value' => 'subject.teacher',
            ],
            /*
            [
                'attribute' => 'matricula',
                'label' => 'Student Id',
                'value' => 'student.student_id',
            ],
            [
                'attribute' => 'curriculum',
                'label' => 'Curriculum',
                'value' => 'student.curriculum_id',
            ],
            */
            [
                'attribute' => 'modality',
                'label' => 'Modality',
                'value' => function($dataProvider){
                    if($dataProvider['modality'] == '0') return 'Ordinario';
                    if($dataProvider['modality'] == '1') return 'Extraordinario';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
