<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuration".
 *
 * @property integer $id
 * @property integer $max_subject_regular
 * @property integer $max_subject_extraordinary
 * @property string $instructions_before_open
 * @property string $instructions_while_open
 * @property string $instructions_after_close
 * @property string $confirmation_msg
 * @property string $date_open
 * @property string $date_close
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['max_subject_regular', 'max_subject_extraordinary', 'instructions_before_open', 'instructions_while_open', 'instructions_after_close', 'confirmation_msg', 'date_open', 'date_close'], 'required'],
            [['max_subject_regular', 'max_subject_extraordinary'], 'integer'],
            [['instructions_before_open', 'instructions_while_open', 'instructions_after_close', 'confirmation_msg'], 'string'],
            [['date_open', 'date_close'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'max_subject_regular' => Yii::t('app', 'Max Subject Regular'),
            'max_subject_extraordinary' => Yii::t('app', 'Max Subject Extraordinary'),
            'instructions_before_open' => Yii::t('app', 'Instructions Before Open'),
            'instructions_while_open' => Yii::t('app', 'Instructions While Open'),
            'instructions_after_close' => Yii::t('app', 'Instructions After Close'),
            'confirmation_msg' => Yii::t('app', 'Confirmation Message'),
            'date_open' => Yii::t('app', 'Date Open'),
            'date_close' => Yii::t('app', 'Date Close'),
        ];
    }
}
