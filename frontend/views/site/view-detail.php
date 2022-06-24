<?php

use common\models\User;
use common\models\UserAddress;
use common\models\UserDetail;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $user_detail UserDetail
 * @var $user_address UserAddress
 * @var $user User
 */
?>
<div class="card-header d-flex">
    <h5 class="m-0 align-self-center">View Detail</h5>
    <div class="text-right done-button">
        <?= \yii\helpers\Html::a('Done',['site/index'],['class'=>'btn btn-primary'])?>
    </div>
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>First Name: </strong><?= $user_detail->first_name?></li>
    <li class="list-group-item"><strong>Last Name: </strong><?= $user_detail->last_name?></li>
    <li class="list-group-item"><strong>Mobile Number: </strong><?= $user_detail->mobile_number?></li>
    <li class="list-group-item"><strong>Age: </strong><?= $user_detail->age?></li>
</ul>
</div>
<div class="card mt-4">
    <h5 class="card-header"> View Address</h5>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>City: </strong><?= $user_address->city?></li>
        <li class="list-group-item"><strong>State: </strong><?= $user_address->state?></li>
        <li class="list-group-item"><strong>Post Code: </strong><?= $user_address->post_code?></li>
        <li class="list-group-item"><strong>Address: </strong><?= $user_address->address?></li>
        <li class="list-group-item"><strong>Landmark: </strong><?= $user_address->landmark?></li>
    </ul>

<?php
$current_page_url = Url::toRoute(['site/view-detail']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
?>