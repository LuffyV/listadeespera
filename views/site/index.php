<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Lista de Espera';
?>

<?php
    $horarioSistema = (new \yii\db\Query())
        ->select(['date_open', 'date_close'])
        ->from('configuration')
        ->one();

    // antes de la hora de inicio
    if(new DateTime() < new DateTime($horarioSistema['date_open'])){
        $instruccionesSistema = "instructions_before_open";
    }
    // entre la hora de inicio y la hora de cierre
    if(new DateTime() > new DateTime($horarioSistema['date_open']) && new DateTime() < new DateTime($horarioSistema['date_close'])){
        $instruccionesSistema = "instructions_while_open";
    }
    // depués de la hora de cierre
    if(new DateTime() > new DateTime($horarioSistema['date_close'])){
        $instruccionesSistema = "instructions_after_close";
    }

    $instruccionesCarga = (new \yii\db\Query())
        ->select([$instruccionesSistema])
        ->from('configuration')
        ->one();    
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Mensaje de entrada!</h1>
        <p class="lead">Lee con cuidado las instrucciones que se presentan a continuación.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-10">
                <h2>Hora de Inicio</h2>
                <p>
                    <?php echo $horarioSistema['date_open'] ?>
                </p>
            </div>
            <div class="col-lg-10">
                <h2>Esto es lo que se debe mostrar</h2>
                <p>
                    <?php echo $instruccionesCarga[$instruccionesSistema] ?>
                </p>
            </div>
            <div class="col-lg-10">
                <h2>Hora de Cierre</h2>
                <p>
                    <?php echo $horarioSistema['date_close'] ?>
                </p>
            </div>
        </div>
    </div>
</div>
