<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registration;

/**
 * RegistrationSearch represents the model behind the search form about `app\models\Registration`.
 */
class RegistrationSearch extends Registration
{
    public $teacher;
    public $matricula;
    public $curriculum;
    public $modelo;
    public $student_model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id', 'student_id', 'modality', 'created_at'], 'safe'],
            [['teacher', 'matricula', 'curriculum', 'modelo', 'student_model'], 'safe'],
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
        $query = Registration::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['subject', 'student']);

        $query->andFilterWhere(['like', 'subject.name', $this->subject_id])
            ->andFilterWhere(['like', 'subject.teacher', $this->teacher])
            ->andFilterWhere(['like', 'student.student_id', $this->student_id])
            ->andFilterWhere(['like', 'student.model', $this->student_model])
            ->andFilterWhere(['like', 'student.curriculum_id', $this->curriculum])
            ->andFilterWhere(['like', 'modality', $this->modality])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ;
            // ->andFilterWhere(['modality' => 0]);
        return $dataProvider;
    }
}
