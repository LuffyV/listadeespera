<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property string $id
 * @property string $name
 * @property string $teacher
 * @property string $schedule
 * @property string $classroom
 * @property integer $educational_model
 *
 * @property Registration[] $registrations
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'educational_model'], 'required'],
            [['educational_model'], 'integer'],
            [['name', 'teacher'], 'string', 'max' => 100],
            [['schedule'], 'string', 'max' => 135],
            [['classroom'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'teacher' => Yii::t('app', 'Teacher'),
            'schedule' => Yii::t('app', 'Schedule'),
            'classroom' => Yii::t('app', 'Classroom'),
            'educational_model' => Yii::t('app', 'Educational Model'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['subject_id' => 'id']);
    }

    public function beforeSave(){
        if($this->teacher == null){
            $this->teacher = "NOT DEFINED";
        }
        if($this->schedule == null){
            $this->schedule = "NOT DEFINED";
        }
        if($this->classroom == null){
            $this->classroom = "NOT DEFINED";
        }
        return true;
    }
}
