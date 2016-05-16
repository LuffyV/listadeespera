<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfigurationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Configurations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuration-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // 'id',
            'max_subject_regular',
            'max_subject_extraordinary',
            // 'instructions_before_open:html',
            // 'instructions_while_open:html',
            // 'instructions_after_close:html',
            // 'confirmation_msg:html',
            'date_open',
            'date_close',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

</div>
