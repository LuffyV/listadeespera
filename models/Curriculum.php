<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curriculum".
 *
 * @property string $id
 * @property string $name
 * @property string $short_name
 *
 * @property Student[] $students
 */
class Curriculum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['short_name'], 'string', 'max' => 10]
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
            'short_name' => Yii::t('app', 'Short Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['curriculum_id' => 'id']);
    }
}
