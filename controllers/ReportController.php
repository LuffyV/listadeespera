<?php
namespace app\controllers;
use app\models\Subject;
use app\models\Student;
use app\models\Curriculum;
use app\models\Registration;
use app\models\ReportForm;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ReportController extends Controller
{
    public function actionIndex()
    {
        $model = new ReportForm();
        if($model->load(Yii::$app->request->post()) && $model) {
            $titulo = $model->titulo;
            $tipo = $model->tipo;
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$titulo.'.csv');
            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');
            
            // reporte de materias
            if($tipo == 0){
                fputcsv($output, array('id', 'Nombre', 'Maestro', 'Horario', 'Salón', 'Modelo Educativo'));
                $rows = Subject::find()->all();
                foreach ($rows as $row) {
                    $subject = $this->findSubject($row->getAttribute('id'));
                    $data = array(
                        $row->getAttribute('id'),
                        $row->getAttribute('name'),
                        $row->getAttribute('teacher'),
                        $row->getAttribute('schedule'),
                        $row->getAttribute('classroom'),
                        $row->getAttribute('educational_model'),
                        );
                    if($data[5] == 0){
                        $data[5] = "MEFI";
                    }
                    if($data[5] == 1){
                        $data[5] = "MEyA";
                    }
                    if($data[5] == 2){
                        $data[5] = "Ambos";
                    }
                    fputcsv($output, $data);
                }
            }

            // reporte de estudiantes
            if($tipo == 1){
                fputcsv($output, array('Nombre', 'Apellidos', 'Matricula', 'Modelo Educativo', 'Carrera', 'Telefono'));
                $rows = Student::find()->all();
                foreach ($rows as $row) {
                    $student = $this->findStudent($row->getAttribute('user_id'));
                    $data = array(
                        $row->getAttribute('first_name'),
                        $row->getAttribute('last_name'),
                        $row->getAttribute('student_id'),
                        $row->getAttribute('model'),
                        $row->getAttribute('curriculum_id'),
                        $row->getAttribute('phone'),
                        );
                    if($data[3] == 0){
                        $data[3] = "MEFI";
                    }
                    if($data[3] == 1){
                        $data[3] = "MEyA";
                    }
                    $data[4] = Curriculum::findOne($data[4])->short_name;
                    fputcsv($output, $data);
                }    
            }

            if($tipo == 2){
                fputcsv($output, array('Materia', 'Maestro', 'Matricula', 'Modelo Estudiante', 'Carrera', 'Modalidad', 'Creado el'));
                $rows = Registration::find()->all();
                foreach ($rows as $row) {
                    $registration = $this->findRegistration($row->getAttribute('id'));
                    $rawData = array(
                        $row->getAttribute('subject_id'),
                        $row->getAttribute('student_id'),
                        $row->getAttribute('modality'),
                        $row->getAttribute('created_at'),
                        );

                    if($rawData[2] == 0) $rawData[2] = "Ordinario"; 
                    if($rawData[2] == 1) $rawData[2] = "Extraordinario";

                    $data = array(
                        Subject::findOne($rawData[0])->name,            // materia
                        Subject::findOne($rawData[0])->teacher,         // maestro
                        Student::findOne($rawData[1])->student_id,      // matricula
                        Student::findOne($rawData[1])->model,           // modelo estudiante
                        Student::findOne($rawData[1])->curriculum_id,   // carrera
                        $rawData[2],                                    // modalidad
                        $rawData[3],                                    // creado el
                    );

                    if($data[3] == 0) $data[3] = "MEFI";
                    if($data[3] == 1) $data[3] = "MEyA";
                    if($data[3] == 2) $data[3] = "Ambos";
                    $clearData = array(
                        $data[0], $data[1], $data[2], $data[3],
                        Curriculum::findOne($data[4])->short_name,
                        $data[5], $data[6],
                    );
                    fputcsv($output, $clearData);
                }    
            }
            fclose($output);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    protected function findSubject($id)
    {
        if (($model = Subject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findStudent($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findRegistration($id)
    {
        if (($model = Registration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}