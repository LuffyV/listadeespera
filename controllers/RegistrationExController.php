<?php

namespace app\controllers;

use Yii;
use app\models\Student;
use app\models\Curriculum;
use app\models\RegistrationEx;
use app\models\RegistrationExSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrationExController implements the CRUD actions for RegistrationEx model.
 */
class RegistrationExController extends Controller
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
                        'roles' => ['administrator'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'confirmation'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all RegistrationEx models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrationExSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegistrationEx model.
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
     * Creates a new RegistrationEx model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $queryExtraordinarios = (new \yii\db\Query())
            ->select(['max_subject_extraordinary'])
            ->from('configuration')
            ->where(['id' => 1])
            ->one();
        $numExtraordinarios = (int)$queryExtraordinarios["max_subject_extraordinary"];

        // si no se pueden cargar extraordinarios, no deje entrar a los estudiantes
        if($numExtraordinarios == 0 && !Yii::$app->user->can('administrator')){
            return $this->goHome();
        } else {
            if(Yii::$app->request->post()){
                /* Se cuenta el número de materias que se quieren guardar, junto con los datos
                 de cada una y el teléfono del usuario para guardar cada materia y al final
                 actualizar el teléfono */    
                $count = count(Yii::$app->request->post('RegistrationEx', null)['subject_id']);
                $phone = Yii::$app->request->post('Student')['phone'];
                $datos = Yii::$app->request->post('RegistrationEx', null)['subject_id'];
                $registrations = [new RegistrationEx()];

                for($i = 0; $i < $count; $i++) {
                    $registrations[$i] = new RegistrationEx();
                    $registrations[$i]->subject_id = $datos[$i];
                    $registrations[$i]->save(false);
                    // print_r($registrations[$i]);
                }
                // sólo se actualiza si escriben algo dentro del campo
                if($phone != ""){
                    $stu = Student::findOne(Yii::$app->user->identity->id);
                    $stu->phone = $phone;
                    $stu->update();
                }
                return $this->redirect('confirmation');
            } else {
                $model = new RegistrationEx();
                $modelStu = new Student();
                return $this->render('create', [
                    'model' => $model,
                    'modelStu' => $modelStu,
                ]);
            }            
        }
    }

    public function actionConfirmation(){
        return $this->render('confirmation');
    }

    /**
     * Updates an existing RegistrationEx model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RegistrationEx model.
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
     * Finds the RegistrationEx model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RegistrationEx the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegistrationEx::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
