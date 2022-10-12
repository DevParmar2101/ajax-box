<?php

use common\components\ActiveForm;
use common\models\User;
use common\models\UserAddress;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var $user User */
/** @var $user_address UserAddress */
/** @var $form ActiveForm */

$this->title = 'User Address';

?>
    <h3 class="card-header">Username: <?php echo $user->username?></h3>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action'=>['site/address'],'id' => 'address-form'])?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($user_address,'city')->textInput()?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($user_address,'state')->textInput()?>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col">
                <?= $form->field($user_address,'post_code')->textInput()?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($user_address,'landmark')->textInput()?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($user_address,'address')->textarea(['rows'=>6])?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($user_address,'status')->dropDownList([$user_address->status()])?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>

        <?php ActiveForm::end()?>
    </div>
<?php
$current_page_url = Url::toRoute(['site/address']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
