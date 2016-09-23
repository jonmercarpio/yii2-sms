<?php

namespace jonmer09\sms\controllers;

use common\components\Controller;
use jonmer09\sms\models\SmsViewConversationSearch;

/**
 * Description of ChatController
 * Sep 20, 2016 3:08:33 PM
 * @author Jonmer Carpio <jonmer09@gmail.com>
 * 
 */
class ChatController extends Controller {

    public function actionIndex() {

        $search = new SmsViewConversationSearch();
        $provider = $search->search($this->get());

        /* @var $query \yii\db\ActiveQuery */
        $query = $provider->query;
        $query->select(['to']);
        $query->distinct(true);

        return $this->render('index', ['search' => $search, 'provider' => $provider]);
    }

    public function actionChat($to) {
        $search = new SmsViewConversationSearch();
        $provider = $search->search($this->get());

        /* @var $query \yii\db\ActiveQuery */
        $query = $provider->query;
        $query->andWhere(['to' => $to]);
        $provider->pagination = false;
        return $this->render('chat', ['search' => $search, 'provider' => $provider, 'to' => $to]);
    }

}
