<?php

use common\components\ActiveForm;
use common\models\User;
use common\models\UserDetail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var $user User */
/** @var $user_detail UserDetail */
/** @var $form ActiveForm */

?>
    <h3 class="card-header">Username: <?php echo $user->username?></h3>
<div class="card-body">

<?php $form = ActiveForm::begin(['id' => 'detail-form'])?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($user_detail,'first_name')->textInput()?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($user_detail,'last_name')->textInput()?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($user_detail,'age')->textInput()?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($user_detail,'mobile_number')->textInput()?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Next', ['class' => 'btn btn-primary', 'name' => 'detail-button']) ?>
    </div>

<?php ActiveForm::end()?>

</div>

<?php
$current_page_url = Url::toRoute(['site/detail']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
