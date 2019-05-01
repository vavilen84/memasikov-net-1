<script src="/js/userImage.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="/js/memgenerator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/memgenerator.css">
<?php echo $this->context->renderPartial('tags'); ?>
<div class="center" id="user-image">
    <?php echo Yii::$app->base->getBaseImageHtml($baseImageContainer); ?>
    <div class="center">
        <button class="btn btn-primary" id="download">Скачать</button>
        <button id="copy-link-button" class="copy-image-link btn btn-primary">Скопировать ссылку</button>
        <input type="text" id="image-link" value="<?php echo Yii::$app->base->getUserImagePageUrl($userImageContainer); ?>">
    </div>
</div>
<input type="hidden" id="json" value='<?php echo $userImageContainer->json; ?>'>


