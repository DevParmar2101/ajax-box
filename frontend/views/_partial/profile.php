<?php

use common\models\MultipleDistance;
use common\models\User;
use common\models\UserAddress;
use common\models\UserChatDistance;
use common\models\UserDetail;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\CrudAsset;
/**
 * @var $view_name string
 * @var $user_detail UserDetail
 * @var $user_address UserAddress
 * @var $user User
 * @var $distance UserChatDistance
 * @var $multiple_distance MultipleDistance
 *
 */
CrudAsset::register($this);
?>

<?php Pjax::begin(['id' => 'id-setup-process','enablePushState' => false,'scrollTo' => false]); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <?= $this->render('@app/views/site/'.$view_name,[
                    'user_detail' => $user_detail ?? null,
                    'user_address'=> $user_address ?? null,
                    'user'  => $user ?? null,
                    'distance' => $distance ?? null,
                    'multiple_distance' => $multiple_distance ?? null,
                ])?>

            </div>
        </div>
    </div>
<?php Pjax::end(); ?>