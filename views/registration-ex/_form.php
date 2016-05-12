<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\RegistrationEx;
use app\models\Student;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrationEx */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-form">

    <!-- Evita que se seleccionen más de X materias en el checkbox,
        dependiendo de la configuración actual  -->
    <?php
        $queryExtraordinarios = (new \yii\db\Query())
            ->select(['max_subject_extraordinary'])
            ->from('configuration')
            ->where(['id' => 1])
            ->one();
        $numExtraordinarios = (int)$queryExtraordinarios["max_subject_extraordinary"];
        $numMaterias = 'var extraordinarios = '.$numExtraordinarios.';';

        $this->registerJs($numMaterias);
        $this->registerJs('
        $("[name=\'RegistrationEx[subject_id][]\']").change(function(){
            var registrationCheckEx = $(\'.RegistrationEx :checkbox:checked\').length; 
            if(registrationCheckEx >= extraordinarios){
                $(\'.RegistrationEx :checkbox:not(:checked)\').prop(\'disabled\', true);
            } else {
                $(\'.RegistrationEx :checkbox:not(:checked)\').prop(\'disabled\', false);
            }
        });
    '); ?>

    <!-- Le despliega la información al estudiante para que pueda confirmarla -->
	<?php
        $informacionEstudiante = (new \yii\db\Query())
            ->select(['first_name', 'last_name', 'model', 'curriculum_id'])
            ->from('student')
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->one();
        $nombreCarrera = (new \yii\db\Query())
            ->select(['short_name'])
            ->from('curriculum')
            ->where(['id' => $informacionEstudiante['curriculum_id']])
            ->one();
	?>

    <div class="row">
        <div class="col-lg-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Tu información actual es la siguiente:</h3>
            </div>
            <div class="panel-body">
                <label>
                    Nombre completo:
                    <?php echo $informacionEstudiante['first_name']?>
                    <?php echo $informacionEstudiante['last_name'] ?>
                </label><br>
                <label>
                    Modelo educativo:
                    <?php 
                    $modeloEstudiante = $informacionEstudiante['model'];
                    if($modeloEstudiante == 0) $modeloEstudiante = "MEyA";
                    if($modeloEstudiante == 1) $modeloEstudiante = "MEFI";
                    echo $modeloEstudiante;
                    ?>
                </label><br>
                <label>
                    Carrera: 
                    <?php echo $nombreCarrera['short_name'] ?>
                </label>
            </div>
        </div>
        </div>

        <!-- Checks-->
        <div class="col-lg-7">
            <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>

            <!-- Que se actualice el teléfono del estudiante si es que lo pone -->
            <?= $form->field($modelStu, 'phone')->textInput([
                'maxlength' => true,
                'placeholder' => 'Actualiza tu teléfono',
            ]) ?>

            <?= $form->field($model, 'subject_id')->checkboxList(
                ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
                array('class'=>'RegistrationEx'))
            ?>
        </div>
        <div class="form-group">
            <?php 
                echo PopoverX::widget([
                    'header' => '¿Estás completamente seguro?',
                    'placement' => PopoverX::ALIGN_RIGHT,
                    'content' => "Revisa bien tu información antes de continuar.
                    Una vez que aceptes NO PODRÁS REALIZAR CAMBIOS y tendrás que comunicarte con Control Escolar
                    en caso de que sea necesario.",
                    'footer' => Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'),
                        ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary']) 
                    .
                    Html::button("Cancelar", ["class"=>"btn btn-danger btn-sm", 'data-dismiss' => 'popover-x']),
                    'toggleButton' => ['label'=>'Guardar', 'class'=>'btn btn-primary'],
                ]);
             ?>
        </div>        
    </div>
    <?php ActiveForm::end(); ?>
</div>
