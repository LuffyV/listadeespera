<?php  

namespace app\controllers;

use Yii;
use app\models\Student;
use yii\web\Controller;


class FileImportController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        // 'actions' => ['create', 'update', 'view', 'index', 'delete'],
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }

    public function actionImport(){
        $model = new FileImport();
        if(isset($_POST['csvFile'])){
            echo 'Hola';
        } else {
            return $this->render('import',
                [
                    'model' => $model,
                ]);            
        }
    }
}