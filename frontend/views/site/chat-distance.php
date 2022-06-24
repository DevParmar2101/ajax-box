<?php

use yii\helpers\Url;
?>


<?php
$current_page_url = Url::toRoute(['site/chat-distance']);
$js_page_reload = <<<JS
window.history.pushState('', '', "$current_page_url");
JS;
$this->registerJs($js_page_reload);
?>