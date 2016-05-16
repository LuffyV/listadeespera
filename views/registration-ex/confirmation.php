<?php 
use yii\helpers\Html;

$mensajeConfirmacion = (new \yii\db\Query())
  ->select(['confirmation_msg'])
  ->from('configuration')
  ->one();   
?>

<div class="confirmation">
  <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
    <strong>Éxito!</strong> Las materias que has pedido se guardaron correctamente dentro de la lista de espera.
  </div>

	<div class="row">
	  <div class="col-lg-8">
		  <img src="http://s3-media2.fl.yelpcdn.com/bphoto/DHkK1_Jn1umOUqyLAm7Yrw/o.jpg" id="conf-img">
	  </div>
	  <div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">
			      <h3 class="panel-title">Todo terminado</h3>
		    </div>
		    <div class="panel-body">
		    	<?php echo $mensajeConfirmacion['confirmation_msg'] ?>
		    </div>
	  	</div>
		</div>
	</div>
</div>