<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RegistrationEx;

/**
 * RegistrationExSearch represents the model behind the search form about `app\models\RegistrationEx`.
 */
class RegistrationExSearch extends RegistrationEx
{
    public $teacher;
    public $matricula;
    public $curriculum;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id', 'student_id', 'modality'], 'safe'],
            [['teacher', 'matricula', 'curriculum'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RegistrationEx::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('subject', 'student');

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['modality' => 1]);
            // ->andFilterWhere(['like', 'modality', $this->modality]);

        return $dataProvider;
    }
}
