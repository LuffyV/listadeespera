<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class FileImport extends Model
{
    /**
     * @var UploadedFile
     */
    public $csvFile;

    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'csvFile' => Yii::t('app', 'CSV File'),
        ];
    }
}