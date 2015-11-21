<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $student_id
 * @property string $model
 * @property string $curriculum_id
 * @property string $phone
 *
 * @property Users $user
 * @property Curriculum $curriculum
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'student_id', 'model', 'curriculum_id'], 'required'],
            [['model', 'curriculum_id'], 'integer'],
            [['first_name', 'last_name', 'student_id'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'student_id' => Yii::t('app', 'Student ID'),
            'model' => Yii::t('app', 'Model'),
            'curriculum_id' => Yii::t('app', 'Curriculum'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum()
    {
        return $this->hasOne(Curriculum::className(), ['id' => 'curriculum_id']);
    }

    public function beforeSave(){
        return true;
    }
}
