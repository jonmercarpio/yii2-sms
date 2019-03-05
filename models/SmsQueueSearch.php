<?php

/**
 * Description of SmsQueueSearch
 * Sep 20, 2016 12:08:59 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */

namespace jonmercarpio\sms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use jonmercarpio\sms\models\SmsQueue;

/**
 * SmsQueueSearch represents the model behind the search form of `jonmercarpio\sms\models\SmsQueue`.
 */
class SmsQueueSearch extends SmsQueue {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'list_id', 'created_by'], 'integer'],
            [['to', 'from', 'body', 'error_code', 'error_message', 'date_sent_utc', 'sid', 'direction', 'account_sid', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = SmsQueue::find();

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
            'list_id' => $this->list_id,
            'date_sent_utc' => $this->date_sent_utc,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'to', $this->to])
                ->andFilterWhere(['like', 'from', $this->from])
                ->andFilterWhere(['like', 'body', $this->body])
                ->andFilterWhere(['like', 'error_code', $this->error_code])
                ->andFilterWhere(['like', 'error_message', $this->error_message])
                ->andFilterWhere(['like', 'sid', $this->sid])
                ->andFilterWhere(['like', 'direction', $this->direction])
                ->andFilterWhere(['like', 'account_sid', $this->account_sid]);

        return $dataProvider;
    }

}
