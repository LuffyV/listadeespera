<?php
namespace app\models;
use yii\base\Model;

class TruncateForm extends Model {
		public $tabla;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['tabla', 'string'], 'required'],   
        ];
    }
}