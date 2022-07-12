<?php

use common\components\ActiveForm;
use common\models\MultipleDistance;
use common\models\User;
use common\models\UserAddress;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var $form ActiveForm
 * @var $multiple_distance MultipleDistance[]
 * @var $user User
 * @var $user_address UserAddress
 * @var $all_models_validation boolean
 * @var $pjaxId array
 */

if (!isset($multiple_distance)) {
    $multiple_distance['db']= MultipleDistance::find()->where(['user_id' => Yii::$app->user->identity->id])->indexBy('uuid')->all();
}
if (!isset($multiple_distance['unsaved'])) {
    $unsaved_count = count(array($multiple_distance['name']));
}else{
    $unsaved_count = 0;
}
if (isset($multiple_distance['db'])) {
    $db_count = count(array($multiple_distance['db']));
}else{
    $db_count = 0;
}
?>
<?php
if (!isset($all_models_validation)) {
    $all_models_validation = true;
}
if (isset($reload) && $reload) {
    $address = $user_address->uuid;
    $js = <<<JS
    $.pjax.reload({container:"#category-list-$address",async: false}).done(function (){
        $("#flush-heading-$address").trigger('click');
    });
JS;
    $this->registerJs($js);
}
?>
    <div class="card-header d-flex">
        <h5 class="m-0 align-self-center">Multiple Distance</h5>
        <div class="text-right done-button">
            <?= Html::a('Next',['site/detail'],['class'=> 'btn  btn-primary','data-pjax-custom' => '#id-setup-process'])?>
        </div>
    </div>
<?php Pjax::begin(['id' => 'test', 'enablePushState' => false,'scrollTo' => false]); ?>
<?php $form = ActiveForm::begin([
    'id' => 'multiple-form',
])?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-11 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($multiple_distance,'name[1]')->textInput()?>
                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($multiple_distance,'price[1]')->textInput()?>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-sm-3 col-xs-12 align-self-center">
                <div class="text-center col-sm-3 col-xs-12 align-self-center mt-3">
                    <?= Html::a(
                        '<i class="fa fa-plus"></i>',
                        'javascript:void(0);',
                        [
                            'id' => 'add-sub-product-'.$user_address->uuid,
                            'class' => 'collapsed btn-outline-secondary btn btn-sm btn-add-product',
                            'data-div' => 'sub-product-'.$user_address->uuid,
                            'data-product' => $user_address->uuid,
                            'data-pjax-custom' => '0',
                        ]
                    )?>
                </div>
            </div>
        </div>
        <div class="" id="<?= 'sub-product-'.$user_address->uuid?>">
            <input class="<?='counter-sub-product-'.$user_address->uuid?>" name="counter" hidden value="<?=$unsaved_count?($unsaved_count+1):1?>">
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <?= Html::a('Back',['/site/address'],['class' => 'btn btn-success'])?>
            <?= Html::submitButton('Done', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end()?>
<?php Pjax::end()?>
<?php
$current_page_url = Url::toRoute(['site/multiple-distance']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
?>