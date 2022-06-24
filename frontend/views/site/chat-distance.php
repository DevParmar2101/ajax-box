<?php

use common\components\ActiveForm;
use common\models\User;
use common\models\UserChatDistance;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $form ActiveForm
 * @var $distance UserChatDistance
 * @var $user User
 */
if ($user->chatDistance){
    $chatDistance = $user->chatDistance()->orderBy(['id' => SORT_DESC])->all();
}
$chatCreate = Url::toRoute(['/site/chat-distance-create']);
?>

    <h3 class="card-header">By Distance</h3>
    <div class="card-body">
        <?php $form = ActiveForm::begin(['action' => $chatCreate,'id' => 'distance-form'])?>
        <div class="row">
            <div class="col-md-10 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($distance,'km_from')->textInput()?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($distance,'km_to')->textInput()?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($distance,'min_order_price')->textInput()?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($distance,'delivery_price')->textInput()?>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 align-self-center">
                <div class="text-center d-flex square-button mt-3">
                    <button type="submit" class="add-distance-price btn-sm btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::a('Back',['/site/address'],['class' => 'btn btn-success'])?>
            <?php if (count($chatDistance)>=1){ ?>
            <?= Html::a('Done',['/site/index'],['class' => 'btn btn-primary','data-pjax-custom' => '#id-setup-process'])?>
            <?php }?>
        </div>
        <?php ActiveForm::end()?>
    </div>

<?php
$current_page_url = Url::toRoute(['site/chat-distance']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
?>