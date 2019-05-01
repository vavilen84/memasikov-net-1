<script src="/js/imageList.js?v=<?php echo time(); ?>"></script>
<div class="index-page-float-block center">
    <div class="image-previews">
        <?php foreach ($imageContainers as $container): ?>
            <?php echo Yii::$app->base->getImageHtml($container); ?>
        <?php endforeach; ?>
    </div>
    <?php echo $this->context->renderPartial('pager', ['pages' => $pages, 'lastPageNumber' => $lastPageNumber]); ?>
</div>
<div class="center mtb10 white">
    <span id="current-image-number">
        <?php echo $currentImageContainer->number; ?>
    </span> из <?php echo Yii::$app->base->getTotalImagesCount(); ?>
</div>
<div class="image-link center">
    <button id="copy-link-button" class="copy-image-link btn btn-primary">Скопировать ссылку</button>
    <input type="text" id="image-link" value="<?php echo Yii::$app->base->getImagePageUrl(); ?>">
    <a download class="download-link btn btn-primary" href="<?php echo Yii::$app->base->getImageUrl($currentImageContainer); ?>">Скачать</a>
</div>
<div class="index-page-float-block center">
    <div class="image-wrap">
        <?php echo $this->context->renderPartial('controls'); ?>
        <div class="image">
            <?php echo Yii::$app->base->getImageHtml($currentImageContainer); ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php echo Yii::$app->base->getLastImageActiveInputHtml($lastImageActive);


