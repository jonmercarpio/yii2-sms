<?php

namespace jonmercarpio\sms\components;

use yii\web\Controller as BaseController;
use Yii;
use yii\web\Response;
use yii\base\ExitException;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * Description of Controller
 *
 * @property \yii\caching\FileCache $cache
 * @author jcarpio
 */
class Controller extends BaseController {

    /**
     * Performs AJAX validation.
     *
     * @param array|Model $model
     *
     * @throws ExitException
     */
    protected function performAjaxValidation($models = []) {
        $allLoaded = true;
        $result = [];
        $validateModels = is_array($models) ? $models : [$models];
        if ($this->isAjax() && !$this->isPjax() && $this->post('ajax')) {
            foreach ($validateModels as $model) {
                $allLoaded = $allLoaded ? $model->load($this->post()) : false;
                if ($allLoaded) {
                    $result = ArrayHelper::merge($result, ActiveForm::validate($model));
                }
            }
            if ($allLoaded) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode($result);
                Yii::$app->end();
            }
        }
    }

    public function render($view, $params = array()) {
        if ($this->isAjax()) {
            if ($this->get('rjson') || $this->post('rjson')) {
                Yii::$app->response->format = Response::FORMAT_JSON;
            }
            return parent::renderAjax($view, $params);
        } else {
            return parent::render($view, $params);
        }
    }

    public function getRequest() {
        return \Yii::$app->getRequest();
    }

    public function getReponse() {
        return \Yii::$app->getResponse();
    }

    public function get($id = null, $default = null) {
        return $this->getRequest()->get($id, $default);
    }

    public function post($name = null, $default = null) {
        return $this->getRequest()->post($name, $default);
    }

    protected function findModel($id) {
        return $this->findModelFromClass($id, $this->modelClass());
    }

    public function findModelFromClass($id, $class) {
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     * @return \backend\models\User;
     */
    protected function getCurrentUser() {
        return Yii::$app->user->identity;
    }

    protected function redirectToReferrer($url, $statusCode = 302) {
        $_url = $this->getRequest()->getReferrer() ? $this->getRequest()->getReferrer() : $url;
        return $this->get('redirect', true) ? $this->redirect($_url, $statusCode) : "";
    }

    protected function dump($var, $exit = true) {
        CVarDumper::dump($var);
        if ($exit) {
            \Yii::$app->end();
        }
    }

    /**
     * @param \yii\db\ActiveQuery $query ActiveQuery Class
     */
    protected function getModelsFormList($query, $to, $from = "id", $order = null) {
        $array = $query->orderBy($order? : $to)->all();
        return ArrayHelper::map($array, $from, $to);
    }

    public function modelClass() {
        throw new \yii\web\HttpException(500, "Override method modelClass", 0, null);
    }

    protected function modelClassName() {
        return ucfirst($this->id);
    }

    protected function isPost() {
        return $this->getRequest()->isPost;
    }

    protected function isAjax() {
        return $this->getRequest()->isAjax;
    }

    protected function isPjax() {
        return $this->getRequest()->isPjax;
    }

    protected function userID() {
        return $this->getCurrentUser()->id;
    }

    /**
     * @return \yii\caching\FileCache
     */
    protected function getCache() {
        return Yii::$app->cache;
    }

}
