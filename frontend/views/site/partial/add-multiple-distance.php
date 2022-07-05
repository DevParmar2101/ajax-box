<?php

use yii\helpers\Html;

/* @var $counter*/
?>
<div class="row">
    <div class="col-md-11 col-sm-9 col-xs-12">
        <div class="row">
            <div class="col-lg-6">
                <?= Html::textInput("MultipleDistance[$counter]name",null,['class' => 'form-control'])?>
            </div>

            <div class="col-lg-6">
                <?= Html::textInput("MultipleDistance[$counter]price",null,['class' => 'form-control'])?>
            </div>
        </div>
    </div>

    <div class="col-md-1 col-sm-3 col-xs-12 align-self-center">
        <div class="text-center col-sm-3 col-xs-12 align-self-center mt-3">
            <?= Html::a(
                '<i class="fa fa-minus"></i>',
                'javascript:void(0);',
                [
                    'id' => 'add-sub-product',
                    'class' => 'collapsed btn-outline-secondary btn btn-sm btn-add-product',
                    'data-pjax-custom' => '0',
                ]
            )?>
        </div>
    </div>
</div>