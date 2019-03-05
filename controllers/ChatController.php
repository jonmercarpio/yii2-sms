<?php

namespace jonmer09\sms\controllers;

use common\components\Controller;
use jonmer09\sms\models\SmsViewConversationSearch;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * Description of ChatController
 * Sep 20, 2016 3:08:33 PM
 * @author Jonmer Carpio <jonmer09@gmail.com>
 * 
 */
class ChatController extends Controller
{

    public function beforeAction($action)
    {
        if (!Yii::$app->user->identity)
        {
            $this->layout = "remote";
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search = new SmsViewConversationSearch();
        $provider = $search->search($this->get());

        /* @var $query ActiveQuery */
        $query = $provider->query;
        $query->select(['to']);
        $query->distinct(true);

        return $this->render('index', ['search' => $search, 'provider' => $provider]);
    }

    public function actionChat($to)
    {

        if(empty($to)){
            return ' -to- Param is missing';
        }

        $search = new SmsViewConversationSearch();
        $provider = $search->search($this->get());

        /* @var $query ActiveQuery */
        $query = $provider->query;
        $query->andFilterCompare('to', $to, 'LIKE');
        $provider->pagination = false;

        $request_count = $provider->getCount();

        if ($this->isAjax() && $this->get('poll', false))
        {
            $go = 1;
            set_time_limit(300);
            ini_set('memory_limit', '-1');
            session_write_close();

            while (true)
            {
                if ($request_count != $provider->getCount() || $go > 30)
                {
                    break; // break the loop
                }
                sleep(3);
                $go++;
                $provider->prepare(true);
            }
        }

        return $this->render('chat', ['search' => $search, 'provider' => $provider, 'to' => $to, 'url' => Url::current()]);
    }

}
