<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserChatDistanceSearch represents the model behind the search form of `common\models\UserChatDistance`.
 */
class UserChatDistanceSearch extends UserChatDistance
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['km_from', 'km_to', 'min_order_price', 'delivery_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
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
    public function search(array $params): ActiveDataProvider
    {
        $query = UserChatDistance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'km_from' => $this->km_from,
            'km_to' => $this->km_to,
            'min_order_price' => $this->min_order_price,
            'delivery_price' => $this->delivery_price,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
