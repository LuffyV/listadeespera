<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\popover\PopoverX;


/* @var $this yii\web\View */
/* @var $model app\models\TruncateForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Truncate');
$items = ['Registros', 'Materias', 'Estudiantes'];
?>

<div class="truncate-form">
  <h1><?= Html::encode($this->title) ?></h1>

  <?php $form = ActiveForm::begin() ?>

  <?=	$form->field($model, 'tabla')->inline()->radioList($items); ?>

  <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
    	<?php 
    		echo PopoverX::widget([
    			'header' => '<b>Necesitamos asegurarnos de que realmente desees hacer esto</b>',
    			'placement' => PopoverX::ALIGN_RIGHT,
    			'content' => 'Confirma para poder eliminar la tabla, se te pedirá que
    			introduzcas tu contraseña para poder continuar.',
    			'footer' => Html::submitButton('Eliminar esta tabla', ['class' => 'btn btn-success btn-sm'])
    			.
          Html::button("Cancelar", ["class"=>"btn btn-danger btn-sm", 'data-dismiss' => 'popover-x']),
          'toggleButton' => ['label'=>'Eliminar', 'class'=>'btn btn-primary'],
    			]);
    	?>
    </div>

    <?php ActiveForm::end(); ?>  
</div>