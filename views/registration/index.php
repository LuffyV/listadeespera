<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Curriculum;
use app\models\Student;

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
                'label' => Yii::t('app', 'Subject'),
                'value' => 'subject.name',
            ],
            [
                'attribute' => 'teacher',
                'label' => Yii::t('app', 'Teacher'),
                'value' => 'subject.teacher',
            ],
            [
                'attribute' => 'student_id',
                'label' => Yii::t('app', 'Student ID'),
                'value' => 'student.student_id',
            ],
            [
                'attribute' => 'curriculum',
                'label' => Yii::t('app', 'Curriculum'),
                'value' => function($dataProvider){
                    return Curriculum::findOne(Student::findOne($dataProvider["student_id"])->curriculum_id)->short_name;
                },
            ],
            [
                'attribute' => 'modality',
                'label' => Yii::t('app', 'Modality'),
                'value' => function($dataProvider){
                    if($dataProvider['modality'] == '0') return 'Ordinario';
                    if($dataProvider['modality'] == '1') return 'Extraordinario';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
