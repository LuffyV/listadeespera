<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Configuration;

/**
 * ConfigurationSearch represents the model behind the search form about `app\models\Configuration`.
 */
class ConfigurationSearch extends Configuration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'max_subject_regular', 'max_subject_extraordinary'], 'integer'],
            [['instructions_before_open', 'instructions_while_open', 'instructions_after_close', 'confirmation_msg','date_open', 'date_close'], 'safe'],
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
        $query = Configuration::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'max_subject_regular' => $this->max_subject_regular,
            'max_subject_extraordinary' => $this->max_subject_extraordinary,
            'date_open' => $this->date_open,
            'date_close' => $this->date_close,
        ]);

        $query->andFilterWhere(['like', 'instructions_before_open', $this->instructions_before_open])
            ->andFilterWhere(['like', 'instructions_while_open', $this->instructions_while_open])
            ->andFilterWhere(['like', 'instructions_after_close', $this->instructions_after_close])
            ->andFilterWhere(['like', 'confirmation_msg', $this->confirmation_msg]);

        return $dataProvider;
    }
}
