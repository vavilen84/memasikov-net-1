<?php Yii::$app->response->statusCode = 404; ?>
<div class="site-error center">
    <?php echo $this->context->renderPartial('tags'); ?>
    <h1 class="center">404 - Такой странички неть ... :-(</h1>
    <img style="max-width:100%;" src=" http://memasikov.net.local/img/404_kit.jpg" alt="котик">
</div>
