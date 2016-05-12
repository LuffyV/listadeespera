<?php
namespace app\models;
use yii\base\Model;

class ReportForm extends Model {
    public $titulo;
    public $tipo;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['titulo', 'string'], 'required'],
            [['tipo', 'integer'], 'required'],      
        ];
    }
}