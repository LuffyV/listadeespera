<?php
namespace app\controllers;
use app\models\Subject;
use app\models\Registration;
use app\models\Student;
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
            
            // distintos tipos de reportes
            if($tipo == 0){
                fputcsv($output, array('id', 'name', 'teacher', 'schedule', 'classroom', 'educational_model'));
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
                    fputcsv($output, $data);
                }
            }
            if($tipo == 1){
                fputcsv($output, array('user_id', 'first_name', 'last_name', 'student_id', 'model', 'curriculum_id', 'phone'));
                $rows = Student::find()->all();
                foreach ($rows as $row) {
                    $student = $this->findStudent($row->getAttribute('user_id'));
                    $data = array(
                        $row->getAttribute('user_id'),
                        $row->getAttribute('first_name'),
                        $row->getAttribute('last_name'),
                        $row->getAttribute('student_id'),
                        $row->getAttribute('model'),
                        $row->getAttribute('curriculum_id'),
                        $row->getAttribute('phone'),
                        );
                    fputcsv($output, $data);
                }    
            }            
            if($tipo == 2){
                fputcsv($output, array('id', 'subject', 'student_id', 'modality'));
                $rows = Registration::find()->all();
                foreach ($rows as $row) {
                    $registration = $this->findRegistration($row->getAttribute('id'));
                    $data = array(
                        $row->getAttribute('id'),
                        $row->getAttribute('subject_id'),
                        $row->getAttribute('student_id'),
                        $row->getAttribute('modality'),
                        );
                    fputcsv($output, $data);
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