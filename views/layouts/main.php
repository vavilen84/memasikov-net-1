<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\Base;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <noscript>
        <meta http-equiv="refresh" content="4; URL=/badbrowser.html">
    </noscript>
    <link rel="shortcut icon" href="<?php echo Yii::$app->base->getSelfDomen(); ?>/favicon.ico" type="image/x-icon">
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?php echo $this->context->totalImagesText; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo Yii::$app->request->absoluteUrl; ?>">
    <meta property="og:image" content="<?php echo $this->context->ogImage; ?>">
    <meta property="og:site_name" content="memasikov.net">
    <meta name="description" content="<?php echo $this->context->description; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="yandex-verification" content="745624ec0a1cf4a5">
    <meta property="og:updated_time" content="<?php echo time(); ?>">
    <link rel="canonical" href="<?php echo Yii::$app->request->absoluteUrl; ?>">
    <base href="<?php echo Yii::$app->request->hostInfo; ?>">
    <title><?php echo $this->context->totalImagesText; ?></title>
    <?php echo Html::csrfMetaTags(); ?>
    <?php $this->head(); ?>
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link href="/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <script type="text/javascript">
        Global = {
            homeUrl: '<?php echo Yii::$app->base->getSelfDomen(); ?>',
            title: 'memasikov.net',
            description: '<?php echo $this->context->description; ?>',
            imageUrl: '/image/',
            userImageUrl: '/user-image/',
            currentImage: '',
            targetUrl: '<?php echo Yii::$app->base->getSelfDomen(); ?>',
            createMemUrl: '/upload-new-mem',
            hash: '<?php echo Base::UPLOAD_MEM_HASH; ?>'
        };
    </script>
    <?php if (!empty(Yii::$app->params['is_production'])): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111719374-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-111719374-1');
        </script>
    <?php endif; ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="kot k1">
        <img src="/img/k1-min.png" alt="2 котика">
    </div>
    <div class="kot k3">
        <img src="/img/k3-min.png" alt="котик вжух">
    </div>
    <div class="kot k4">
        <img src="/img/k4.jpg" alt="котик">
    </div>
    <div class="content-wrap">
        <?php
        NavBar::begin(
            [
                'brandLabel' => '<span class="total-images"><h1>'. $this->context->totalImagesText . '</h1></span>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse header-navbar',
                ],
            ]
        ); ?>
        <?php echo Nav::widget(
            [
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    [
                        'label' => 'DELETE LAST',
                        'url' => ['/admin/delete-last'],
                        'visible' => Yii::$app->rolesControl->isAdminUser(),
                        'options' => ['class' => ' btn btn-danger']
                    ],
                    ['label' => 'ГЛАВНАЯ', 'options' => ['class' => 'btn btn-success'], 'url' => ['/']],
                    ['label' => 'КОТОКНОПКА', 'options' => ['id' => 'cat', 'class' => 'btn btn-success'], 'url' => ['/']],
//                    ['label' => 'СДЕЛАТЬ МЕМ', 'options' => ['class' => 'btn btn-success'], 'url' => ['/mem']],
                    ['label' => 'ВАСЯ ЛОЖКИН', 'options' => ['class' => 'btn btn-success'], 'url' => ['/author/vasya-lozkin']],
                ],
            ]
        );
        NavBar::end(); ?>
        <?php echo $content; ?>
        <div class="clear"></div>
    </div>
    <div class="kot k2">
        <img src="/img/k2-min.png" alt="котик">
    </div>
    <div class="footer">
        <div class="center">
            Powered by <a class="underline yii-link" target="_blank" href="http://www.yiiframework.com/">Yii2
                Framework</a>
        </div>
        <div class="center pt10">
            Copyright © <?php echo date('Y'); ?>. All Rights Reserved.
        </div>
    </div>
</div>
<?php $this->endBody(); ?>
<script src="/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="/libs/underscore-min.js"></script>
<script src="/libs/backbone-min.js"></script>
<script src="/js/init.js?v=<?php echo time(); ?>"></script>
</body>
</html>
<?php $this->endPage(); ?>
