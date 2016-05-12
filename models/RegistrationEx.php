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
class RegistrationEx extends \yii\db\ActiveRecord
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
            'subject_id' => Yii::t('app', 'Extraordinary Subjects'),
            'student_id' => Yii::t('app', 'Student ID'),
            'modality' => Yii::t('app', 'Modality (Ex)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['user_id' => 'student_id']);
    }

    public function beforeSave(){
        // guarda directamente el id del estudiante
        if($this->student_id == null){
            $this->student_id = Yii::$app->user->identity->id;
        }

        // todos los que se guarden con este modelo son extraordinarios
        $this->modality = 1;
        return true;
    }
}
