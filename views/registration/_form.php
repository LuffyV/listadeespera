<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use app\models\Registration;
use app\models\Student;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $model app\models\Registration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registration-form">
    <!-- Evita que se seleccionen más de X materias en el checkbox -->
    <?php
        $queryOrdinarios = (new \yii\db\Query())
            ->select(['max_subject_regular'])
            ->from('configuration')
            ->where(['id' => 1])
            ->one();
        $numOrdinarios = (int)$queryOrdinarios["max_subject_regular"];
        $numMaterias = 'var ordinarios = '.$numOrdinarios.';';

        $this->registerJs($numMaterias);
        $this->registerJs('
        $("[name=\'Registration[subject_id][]\']").change(function(){
            var registrationCheck = $(\'.RegistrationReg :checkbox:checked\').length;
            if(registrationCheck >= ordinarios){
                $(\'.RegistrationReg :checkbox:not(:checked)\').prop(\'disabled\', true);
            } else {
                $(\'.RegistrationReg :checkbox:not(:checked)\').prop(\'disabled\', false);
            }
        });
    '); ?>

	<?php
        $informacionEstudiante = (new \yii\db\Query())
            ->select(['first_name', 'last_name', 'model', 'curriculum_id', 'phone'])
            ->from('student')
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->one();
        $nombreCarrera = (new \yii\db\Query())
            ->select(['short_name'])
            ->from('curriculum')
            ->where(['id' => $informacionEstudiante['curriculum_id']])
            ->one();
        $registrosOrdinariosPrevios = (new \yii\db\Query())
            ->select(['subject_id'])
            ->from('registration')
            ->where(['student_id' => Yii::$app->user->identity->id])
            ->andWhere(['modality' => 0])
            ->all();
        $contadorOrdinariosCargados = count($registrosOrdinariosPrevios);
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
                    $modeloEstudianteNum = $informacionEstudiante['model'];
                    if($modeloEstudianteNum == 0) $modeloEstudianteTxt = "MEFI";
                    if($modeloEstudianteNum == 1) $modeloEstudianteTxt = "MEyA";
                    echo $modeloEstudianteTxt;
                    ?>
                </label><br>
                <label>
                    Carrera: 
                    <?php echo $nombreCarrera['short_name'] ?>
                </label><br>
                <label>
                    Teléfono:
                    <?php echo $informacionEstudiante['phone'] ?>
                </label><br><br>
                <?php
                if($contadorOrdinariosCargados > 0){
                    echo "<label>Materias que ya has cargado:<br>";
                    foreach($registrosOrdinariosPrevios as $row => $innerArray){
                        foreach($innerArray as $innerRow => $value){
                            $nombreMateria = Subject::findOne($value)->name;
                            echo "<li>" . $nombreMateria . "</li>";
                        }
                    }
                    echo "</label>";
                }
                ?>
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
            <?php if($contadorOrdinariosCargados == 0){ ?>
                <?= $form->field($modelStu, 'phone')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Actualiza tu teléfono',
                    ]);
                ?>
            <?php } ?>

            <?php if($contadorOrdinariosCargados == 0){ ?> 
                <?= $form->field($model, 'subject_id')->checkboxList(
                    ArrayHelper::map(Subject::find()
                        ->where(['educational_model' => '2'])->orWhere(['educational_model' => $modeloEstudianteNum])
                        ->andWhere(['available' => '1'])->orderBy('name')->all(), 'id', 'name'),
                    array('class'=>'RegistrationReg'));
                ?>
            <?php } ?>
        </div>

        <div class="form-group">
            <?php 
                // sólo muestra el botón si no has cargado materias
                if($contadorOrdinariosCargados == 0){
                    echo PopoverX::widget([
                        'header' => '<b>¿Estás completamente seguro?</b>',
                        'type' => PopoverX::TYPE_INFO,
                        'placement' => PopoverX::ALIGN_RIGHT,
                        'content' => "Revisa bien tu información antes de continuar.
                        Una vez que aceptes NO PODRÁS REALIZAR CAMBIOS y tendrás que comunicarte con Control Escolar
                        en caso de que sea necesario.",
                        'footer' => Html::submitButton($model->isNewRecord ? Yii::t('app', 'Accept') : Yii::t('app', 'Update'),
                            ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary']) 
                        .
                        Html::button("Cancelar", ["class"=>"btn btn-danger btn-sm", 'data-dismiss' => 'popover-x']),
                        'toggleButton' => ['label'=>'Guardar', 'class'=>'btn btn-primary'],
                    ]);
                }
             ?>
        </div>        
    </div>
    <?php ActiveForm::end(); ?>
</div>
