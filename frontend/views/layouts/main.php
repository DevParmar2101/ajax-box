<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100 mt-10">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'Detail', 'url' => ['/site/detail']];
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div id="preloader" style="display: none;">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="preloader-pjax" style="display: none;">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="content-body content-height">
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <?php
    $product_url = \yii\helpers\Url::toRoute(['site/add-multiple-distance']);
    $user_id = Yii::$app->user->identity->id;
    $js_pjax = <<<JS
$.pjax.defaults.scrollTo=false;
$("body").bind("ajaxComplete", function(e, xhr, settings){
    var handleMinHeight = function() {
		var win_h = window.outerHeight;
		if (win_h > 0 ? win_h : screen.height) {
			$(".content-body").css("min-height", (win_h + 60) + "px");
		}
	}
    handleMinHeight();
});
$(document).on('submit', 'form[data-pjax-custom]', function(event) {
    event.preventDefault();
    $(this).submit(function () {
        return false;
    });
    var pjaxId = $(this).attr('pjax-id');
    if(!pjaxId){
        pjaxId = 'id-setup-process';
    }
    $.pjax.submit(event, {
        "pushRedirect": true,
        "replaceRedirect": false,
        "push":false,
        "replace":false,
        "timeout":false,
        "scrollTo":false,
        "container":'#'+pjaxId
    });
});
$(document).on('pjax:send', function() {
  $('#preloader-pjax').fadeTo(0, 50, 'fade');
});
$(document).on('pjax:complete', function() {
  $('#preloader-pjax').fadeOut();
})
$("body").on("submit", "form", function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});

    $(document).on('click',".btn-add-product",function(){  
        var product = $user_id;
        var div = $(this).data('div');
        var counter = 'counter-'+ div;
        var value_counter = $('.'+counter).val();
        var new_value_counter = 0;
        if(!value_counter){
            value_counter = 1;
        }
        new_value_counter = parseInt(value_counter)+1;
        $('.'+counter).val(new_value_counter);
        $.get("$product_url?id="+product+"&value="+value_counter, function(data, status){
            $("#"+div).append(data);  
            $(".sub-product-title-"+product).removeClass('d-none');
            $(".product-price-"+product).addClass('d-none');
        });
    });
JS;
    $this->registerJs($js_pjax);
    ?>

    </body>
    </html>
<?php $this->endPage(); ?>