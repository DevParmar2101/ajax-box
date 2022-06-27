<?php

use common\components\ActiveForm;
use common\models\MultipleDistance;
use common\models\User;
use yii\helpers\Html;

/**
 * @var $form ActiveForm
 * @var $multiple_distance MultipleDistance
 * @var $user User
 */

?>
<div class="card-header d-flex">
    <h5 class="m-0 align-self-center">Multiple Distance</h5>
    <div class="text-right done-button">
        <?= Html::a('Next',['site/detail'],['class'=> 'btn  btn-primary','data-pjax-custom' => '#id-setup-process'])?>
    </div>
</div>
<div class="card-body">
    <?php $form = ActiveForm::begin(['action' => '','id' => 'multiple-form'])?>
    <div class="row">
        <div class="col-md-11 col-sm-9 col-xs-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($multiple_distance,'name')->textInput()?>
                </div>

                <div class="col-lg-6">
                    <?= $form->field($multiple_distance,'price')->textInput()?>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-sm-3 col-xs-12 align-self-center">
            <div class="text-center col=sm-3 col-xs-12 align-self-center mt-3">
                <?= Html::a(
                        '<i class="fa fa-plus"></i>',
                        'javascript:void(0);',
                        [
                            'id' => 'add-sub-product-'.$multiple_distance->uuid,
                            'class' => 'collapsed btn-outline-secondary btn btn-sm btn-add-product',
                            'data-div' => 'sub-product-'.$multiple_distance->uuid,
                            'data-product' => $multiple_distance->uuid,
                            'data-pjax-custom' => '0',
                        ]
                )?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end()?>
</div>
