<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property string $id
 * @property string $subject_id
 * @property string $student_id
 * @property integer $modality
 *
 * @property Subject $subject
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id'], 'required'],
            [['student_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject_id' => Yii::t('app', 'Subjects'),
            'student_id' => Yii::t('app', 'Student ID'),
            'modality' => Yii::t('app', 'Modality (Reg)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    public function beforeSave(){
        $id_numerico = $this->subject_id[0];
        $this->subject_id = $id_numerico;
        
        // guarda directamente el id en vez de pedirlo
        if($this->student_id == null){
            $this->student_id = Yii::$app->user->identity->id;
        }
        
        // $phone = $_GET['Student[phone]'];
        //$queryPhone = (new \yii\db\Query());
        // $queryPhone->createCommand()->update('student', ['phone' => $phone], 'student_id = ' . $this->student_id)->execute();
        
        $this->modality = 0; // todos los que se guarden con este modelo son regulares
        return true;
    }
}
