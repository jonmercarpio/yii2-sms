<?php
/**
 * Created by PhpStorm.
 * User: jcarpio
 * Date: 9/1/16
 * Time: 3:43 PM
 */

namespace jonmercarpio\sms\components;

use Twilio\Rest\Client;
use yii\base\Component;

/**
 * Class TwilioSMS
 * @package jonmercarpio\sms\components
 */
class TwilioSMS extends Component
{

    /**
     * @var Client twilioClass
     *
     */
    private $twilioClass;

    /**
     * @var string $account_sid Username
     */
    public $account_sid;

    /**
     * @var string $auth_key Password
     */
    public $auth_key;

    /**
     * @var string $from Default number
     *
     */
    public $from;

    public function init()
    {
        try {
            $this->twilioClass = new Client($this->account_sid, $this->auth_key);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return Client
     */
    public function getTwilioClient()
    {
        return $this->twilioClass;
    }

    /**
     * @param string $to
     * @param string $body
     * @param null $from
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function sendMessage($to, $body, $from = null)
    {
        return $this->twilioClass->messages->create($to, [
            'from' => $this->getFrom($from),
            'body' => $body
        ]);
    }

    /**
     * @param null $from
     * @return string
     */
    private function getFrom($from = null)
    {
        return $from ?: $this->from;
    }


    public function __call($methodName, $methodParams)
    {
        if (method_exists($this->twilioClass, $methodName)) {
            return call_user_func_array(array($this->twilioClass, $methodName), $methodParams);
        } else {
            return parent::__call($methodName, $methodParams);
        }
    }
}
