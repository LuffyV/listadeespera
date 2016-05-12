<?php 
use yii\helpers\Html;
 ?>
<?php 
    $informacionEstudiante = (new \yii\db\Query())
        ->select(['first_name', 'last_name'])
        ->from('student')
        ->where(['user_id' => Yii::$app->user->identity->id])
        ->one();

    $numeroMateriasElegidas = count($_POST) - 1;

    if($numeroMateriasElegidas == 1){
        if($_POST["Registration"]['subject_id']['0']){
            $materiaPedida0 = (new \yii\db\Query())
            ->select(['name'])
            ->from('subject')
            ->where(['id' => $_POST["Registration"]['subject_id']['0']])
            ->one(); 
        }
        $materiaPedida1 = 'hola';
    }

    try {
        if($numeroMateriasElegidas == 2){
            if($_POST["Registration"]['subject_id']['0']){
                $materiaPedida0 = (new \yii\db\Query())
                ->select(['name'])
                ->from('subject')
                ->where(['id' => $_POST["Registration"]['subject_id']['0']])
                ->one(); 
            }
            if($_POST["Registration"]['subject_id']['1']){
                $materiaPedida1 = (new \yii\db\Query())
                ->select(['name'])
                ->from('subject')
                ->where(['id' => $_POST["Registration"]['subject_id']['1']])
                ->one();    
            }
        }
    } catch (ErrorException $e){
        Yii::warning("Estoy en el catch");
    }
?>
<div class="subject-test">
	<h2>Por favor confirma tus datos antes de enviarlos:</h2>
	<br>
	
	<h4>Estudiante:
		<?php echo $informacionEstudiante['first_name']?>
        <?php echo $informacionEstudiante['last_name'] ?>
    </h4><br>

	<h4>Materia(s) Regulares: <?= Html::encode($materiaPedida0['name'] . ', ' . $materiaPedida1['name']) ?></h4><br>
    <h4>Total de materias pedidas: <?= Html::encode($numeroMateriasElegidas) ?></h4>
	<h4>Teléfono: <?= Html::encode($_POST["Student"]['phone']) ?></h4>
	<br><br>

	<?= Html::a(Yii::t('app', 'Aceptar'), ['test'], ['class' => 'btn btn-success']) ?>

	<?= Html::a(Yii::t('app', 'Regresar'), ['create'], ['class' => 'btn btn-danger']) ?>
</div>