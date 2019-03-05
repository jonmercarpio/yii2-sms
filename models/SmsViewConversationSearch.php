<?php

/**
 * Description of SmsViewConversationSearch
 * Sep 20, 2016 4:32:42 PM
 * @author Jonmer Carpio <jonmer09@gmail.com>
 * 
 */
?>
<?php

namespace jonmercarpio\sms\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use jonmercarpio\sms\models\SmsViewConversation;

/**
 * SmsViewConversationSearch represents the model behind the search form of `jonmercarpio\sms\models\SmsViewConversation`.
 */
class SmsViewConversationSearch extends SmsViewConversation {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['to', 'body', 'created_at', 'direction', 'from'], 'safe'],
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
        $query = SmsViewConversation::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'to', $this->to])
                ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }

}
