<?php
namespace app\models;

use Yii;
use yii\base\Model;

class TruncateForm extends Model {
	public $tabla;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['tabla', 'string'], 'required'],
            [['password', 'string'], 'required'],
        ];
    }
}