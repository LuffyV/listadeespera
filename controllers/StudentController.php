<?php

namespace app\controllers;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use app\models\FileImport;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');

            if ($model->csvFile){
                    $time = time();
                    $model->csvFile->saveAs('csv/' .$time. '.' . $model->csvFile->extension);
                    $model->csvFile = 'csv/' .$time. '.' . $model->csvFile->extension;

                    $handle = fopen($model->csvFile, "r");
                    while (($fileop = fgetcsv($handle, 1000, ",")) !== false){
                        $student_id = $fileop[0];
                        $first_name = $fileop[1];
                        $last_name = $fileop[2];
                        $model = $fileop[3];
                        $curriculum_id = $fileop[4];
                        $password = $fileop[5]; // contraseña 'contra' para pruebas, de momento

                        $username = 'a'.$fileop[0]; // el usuario con el que inician tiene a - ej: a12216345
                        $password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);

                        $userSql = "INSERT INTO users(username, password_hash) VALUES ('$username', '$password_hash')";

                        $studentSql = "INSERT INTO student(student_id, first_name, last_name, model, curriculum_id) 
                        VALUES ('$student_id', '$first_name', '$last_name', '$model', '$curriculum_id')";

                        $queryUsers = Yii::$app->db->createCommand($userSql)->execute();
                        $queryStudent = Yii::$app->db->createCommand($studentSql)->execute();
                    }

                    if ($queryUsers) {
                        echo "Se han registrado todos los datos con éxito. ";
                        if($queryStudent){
                            echo "Se han registrado los estudiantes con éxito";

                            $searchModel = new StudentSearch();
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                            return $this->render('index', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                        } else {
                            echo "Ha ocurrido un error al agregar uno o más estudiantes a la base de datos";
                        }
                    } else {
                        echo "Ha ocurrido un error al agregar uno o más usuarios a la base de datos";
                    }
            }
        } else {
            return $this->render('import',
            [
                'model' => $model,
            ]);
        }
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
