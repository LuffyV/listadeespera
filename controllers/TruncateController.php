<?php 
namespace app\controllers;
use app\models\TruncateForm;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TruncateController extends Controller{
	public function behaviors(){
		return [
			'access' => [
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'roles' => ['administrator'],
					],
				],
			],
		];
	}


	public function actionIndex(){
		$model = new TruncateForm();

		if($model->load(Yii::$app->request->post()) && $model){
			$tabla = $model->tabla;

			$hash = (new \yii\db\Query())
      	->select(['password_hash'])
      	->from('users')
      	->where(['id' => Yii::$app->user->identity->id])
      	->one();
			$correctPassword = Yii::$app->getSecurity()->validatePassword($model->password, $hash['password_hash']);

			if($correctPassword){
				if($tabla == 0){
					Yii::$app->db->createCommand()->truncateTable('registration')->execute();
				}
				if($tabla == 1){
					Yii::$app->db->createCommand('set foreign_key_checks=0')->execute();
					Yii::$app->db->createCommand()->truncateTable('subject')->execute();
					Yii::$app->db->createCommand('set foreign_key_checks=1')->execute();
				}
				/* 
				if($tabla == 2){
					Yii::$app->db->createCommand('set foreign_key_checks=0')->execute();
					Yii::$app->db->createCommand()->truncateTable('student')->execute();
					Yii::$app->db->createCommand('set foreign_key_checks=1')->execute();				
				}
				*/
				return $this->render('index', ['model' => $model]);
			} else {
				// mensaje de error
			}
		} else {
			return $this->render('index', ['model' => $model]);
		}
	}
}
?>