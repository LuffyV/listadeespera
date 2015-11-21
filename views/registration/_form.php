<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\Registration;
use app\models\RegistrationEx;
use app\models\Student;


/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    table {
        margin-right: auto;
        margin-left: auto;
    }
</style>

<div class="registration-form">

    <!-- Evita que se seleccionen más de 2 materias en el checkbox -->
    <?php $this->registerJs('
    $("[name=\'Registration[subject_id][]\']").change(function(){
        var registrationCheck = $(\'.RegistrationReg :checkbox:checked\').length;
        if(registrationCheck >=2){
            $(\'.RegistrationReg :checkbox:not(:checked)\').prop(\'disabled\', true);
        } else {
            $(\'.RegistrationReg :checkbox:not(:checked)\').prop(\'disabled\', false);
        }
    });

    $("[name=\'RegistrationEx[subject_id][]\']").change(function(){
        var registrationCheckEx = $(\'.RegistrationEx :checkbox:checked\').length; 
        if(registrationCheckEx >=2){
            $(\'.RegistrationEx :checkbox:not(:checked)\').prop(\'disabled\', true);
        } else {
            $(\'.RegistrationEx :checkbox:not(:checked)\').prop(\'disabled\', false);
        }
    });
    '); ?>

	<?php  
        $queryOrdinarios = (new \yii\db\Query())
            ->select(['max_subject_regular'])
            ->from('configuration')
            ->where(['id' => 1])
            ->one();

        $numOrdinarios = (int)$queryOrdinarios["max_subject_regular"];

        $queryExtraordinarios = (new \yii\db\Query())
            ->select(['max_subject_extraordinary'])
            ->from('configuration')
            ->where(['id' => 1])
            ->one();

        $numExtraordinarios = (int)$queryExtraordinarios["max_subject_extraordinary"];

        $informacionEstudiante = (new \yii\db\Query())
            ->select(['first_name', 'last_name', 'model', 'curriculum_id'])
            ->from('student')
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->one();
	?>

    <h3>Tu información actual es la siguiente: </h3>
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
        <?php echo $informacionEstudiante['curriculum_id'] ?>
    </label><br><br>

    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <!-- Que se actualice el teléfono del estudiante si es que lo pone -->
    <?= $form->field($modelStu, 'phone')->textInput([
        'maxlength' => true,
        'placeholder' => 'Actualiza tu teléfono',
    ]) ?>

    <!--- El if parece estar invertido por alguna razón?-->
    <?php if($numExtraordinarios == 0){ ?>
        <?= $form->field($model, 'subject_id')->checkboxList(
            ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            array('class'=>'RegistrationReg'))
        ?>
    <?php } else { ?>
    <table>
        <td>
        <?= $form->field($model, 'subject_id')->checkboxList(
            ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            array('class'=>'RegistrationReg'))
        ?>
        </td>
        <td>
        <?= $form->field($modelEx, 'subject_id')->checkboxList(
            ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            array('class'=>'RegistrationEx'))
        ?>
        </td>

    </table>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>

        <?= Html::a(Yii::t('app', 'Test'), ['test'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
