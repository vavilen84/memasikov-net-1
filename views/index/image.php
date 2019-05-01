<script src="/js/imageList.js?v=<?php echo time(); ?>"></script>
<?php echo $this->context->renderPartial('tags'); ?>
<div class="center">
    <?php echo Yii::$app->base->getImageHtml($imageContainer); ?>
</div>
<div class="center mt20">
    <button id="copy-link-button" class="copy-image-link btn btn-primary">Скопировать ссылку</button>
    <input type="text" id="image-link" value="<?php echo Yii::$app->base->getImagePageUrl($imageContainer); ?>">
    <a download class="download-link btn btn-primary" href="<?php echo Yii::$app->base->getImageUrl($imageContainer); ?>">Скачать</a>
</div>


