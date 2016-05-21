<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$extraordinariosPermitidos = (new \yii\db\Query())
->select(['max_subject_extraordinary'])
->from('configuration')
->one();

if($extraordinariosPermitidos['max_subject_extraordinary'] == "0"){
    $seAceptanExtraordinarios = False;
} else {
    $seAceptanExtraordinarios = True;
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Lista de Espera',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
            'style' => 'margin'
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Registrations'),
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => 'Registro Ordinario',
                        'url' => ['/registration/create/'],
                        'visible' => !Yii::$app->user->isGuest,
                    ],
                    [
                        'label' => 'Registro Extraordinario',
                        'url' => ['/registration-ex/create/'],
                        'visible' => ((!Yii::$app->user->isGuest) && ($seAceptanExtraordinarios))
                        || Yii::$app->user->can('administrator'),
                    ],
                    [
                        'label' => 'Catálogo de Registros Generales',
                        'url' => ['/registration/'],
                        'visible' => Yii::$app->user->can('administrator'),
                    ],
                    /*
                    [
                        'label' => 'Catálogo de Registros Extraordinarios',
                        'url' => ['/registration-ex/'],
                        'visible' => Yii::$app->user->can('administrator'),
                    ],
                    */
                ],
            ],
            ['label' => Yii::t('app', 'Administration'),
                'visible' => Yii::$app->user->can('administrator'),
                'items' => [
                    ['label' => Yii::t('app', 'Users'),
                        'url' => ['/user/'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],
                    ['label' => Yii::t('app', 'Students'),
                        'url' => ['/student/'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],
                    ['label' => Yii::t('app', 'Subjects'),
                        'url' => ['/subject/'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],
                    ['label' => Yii::t('app', 'Curriculums'),
                        'url' => ['/curriculum/'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],
                    ['label' => Yii::t('app', 'Configuration'),
                        'url' => ['/configuration/'],
                        'visible' => Yii::$app->user->can('administrator')
                    ],
                    ['label' => 'Vaciar Base de Datos',
                    'url' => ['/truncate/'],
                    'visible' => Yii::$app->user->can('administrator')
                    ],                
                ],
            ],
            ['label' => Yii::t('app', 'Reports'),
                'url' => ['/report/'],
                'visible' => Yii::$app->user->can('administrator')
            ],

            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
