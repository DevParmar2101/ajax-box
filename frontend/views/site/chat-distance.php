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
    $chatDistance = UserChatDistance::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->all();
    $chatCreate = Url::toRoute(['/site/chat-distance-create']);
?>
    <div class="card-header d-flex">
        <h5 class="m-0 align-self-center">By Distance</h5>
        <div class="text-right done-button">
            <?= \yii\helpers\Html::a('Next',['site/view-detail'],['class'=>'btn btn-primary','data-pjax-custom' => '#id-setup-process'])?>
        </div>
    </div>    <div class="card-body">
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
                    <button type="submit" class="add-distance-price btn-sm btn btn-outline-secondary"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::a('Back',['/site/address'],['class' => 'btn btn-success'])?>
            <?php if (count($chatDistance)>=1){ ?>
                <?= Html::submitButton('Done', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?php }?>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>
<div class="card mt-4">
    <h5 class="card-header">Saved by distance</h5>
    <div class="card-body">
        <div class="row">
            <?php foreach ($chatDistance as $distance){?>
            <div class="col-md-10 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($distance,'km_from')->textInput(['readonly' => true])?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($distance,'km_to')->textInput(['readonly' => true])?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($distance,'min_order_price')->textInput(['readonly' => true])?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($distance,'delivery_price')->textInput(['readonly' => true])?>
                    </div>
                </div>
            </div>
                <div class="col-md-2 col-sm-3 col-xs-12 align-self-center">
                    <div class="text-center d-flex">
                        <?= Html::a(' <i class="fa fa-trash"></i> ',['/site/chat-distance-delete','id' => $distance->id],[
                                'role' => 'model-remote',
                                'title' => 'Delete item',
                                'data-pjax-custom' => '0',
                                'class' => 'btn btn-outline-danger btn-sm',
                                'data-confirm' => false,
                                'data-method' => false,
                                'data-request-method' => 'post',
                                'data-confirm-title' => 'Are you sure?',
                                'data-confirm-message' => 'Are you sure you want to delete this?',
                        ]);?>

                    </div>
                </div>
        <?php }?>
        </div>
    </div>
</div>

<?php
$current_page_url = Url::toRoute(['site/chat-distance']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
?>