<?php

namespace jonmercarpio\sms\components;

use yii\web\XmlResponseFormatter as BaseXmlResponseFormatter;

/**
 * Description of XmlResponseFormatter
 * Sep 20, 2016 10:58:25 AM
 * @author Jonmer Carpio <jonmer09@gmail.com>
 * 
 */
class XmlResponseFormatter extends BaseXmlResponseFormatter {

    public $rootTag = 'Response';

}
