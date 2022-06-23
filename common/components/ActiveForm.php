<?php


namespace common\components;

use yii\bootstrap\ActiveField;
use yii\helpers\ArrayHelper;

class ActiveForm extends \yii\bootstrap\ActiveForm
{
    public $fieldClass = ActiveField::class;

    public $pjaxId = '';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->options['pjax-id'] = $this->pjaxId;
        $this->options = ArrayHelper::merge($this->options,['data-pjax-custom' => '']);
        parent::init();
    }

}

