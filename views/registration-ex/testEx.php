<?php 
use yii\helpers\Html;
 ?>

<?php 
    $informacionEstudiante = (new \yii\db\Query())
        ->select(['first_name', 'last_name'])
        ->from('student')
        ->where(['user_id' => Yii::$app->user->identity->id])
        ->one();

    $values = count($_POST);

    // sólo se guardan 
    if($values == 3){

    }
    if($_POST["RegistrationEx"]['subject_id']['0']){
        $materiaPedida1 = (new \yii\db\Query())
        ->select(['name'])
        ->from('subject')
        ->where(['id' => $_POST["RegistrationEx"]['subject_id']['0']])
        ->one();
    }

    if($_POST["RegistrationEx"]['subject_id']['1']){
        $materiaPedida2 = (new \yii\db\Query())
        ->select(['name'])
        ->from('subject')
        ->where(['id' => $_POST["RegistrationEx"]['subject_id']['1']])
        ->one();        
    }
?>

<div class="subject-test">
	<h2>Por favor confirma tus datos antes de enviarlos:</h2>
	<br>
	
	<h4>Estudiante:
		<?php echo $informacionEstudiante['first_name']?>
        <?php echo $informacionEstudiante['last_name'] ?>
    </h4><br>
	<h4>Materia(s) Extraordinarias: <?= Html::encode($materiaPedida1['name'] . ', ' . $materiaPedida2['name']) ?></h4><br>
    <h4>Total de posts: <?= Html::encode($values) ?></h4>
	<h4>Teléfono: <?= Html::encode($_POST["Student"]['phone']) ?></h4>
	<br><br>

	<?= Html::a(Yii::t('app', 'Aceptar'), ['test'], ['class' => 'btn btn-success']) ?>

	<?= Html::a(Yii::t('app', 'Regresar'), ['create'], ['class' => 'btn btn-danger']) ?>
</div>