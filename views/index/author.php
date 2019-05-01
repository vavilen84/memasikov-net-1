<script src="/js/imageList.js?v=<?php echo time(); ?>"></script>
<div class="index-page-float-block center">
    <div class="image-previews">
        <?php foreach ($imageContainers as $container): ?>
            <?php echo Yii::$app->base->getAuthorImageHtml($container); ?>1
        <?php endforeach; ?>
    </div>
    <?php echo $this->context->renderPartial('pager', ['pages' => $pages, 'lastPageNumber' => $lastPageNumber]); ?>
</div>
<div class="image-link center mtb10">
    <button id="copy-link-button" class="copy-image-link btn btn-primary">Скопировать ссылку</button>
    <input type="text" id="image-link" value="<?php echo Yii::$app->base->getAuthorPageUrl($container->authorId); ?>">
    <?php echo Yii::$app->base->getAuthorLinkPageHtml($currentImageContainer); ?>
</div>
<div class="index-page-float-block center">
    <h3 class="center current-image-title white no-margin"><?php echo $currentImageContainer->title; ?></h3>
    <div class="current-image-created-text white"><?php echo $currentImageContainer->createdText; ?></div>
</div>
<div class="index-page-float-block center">
    <div class="image-wrap">
        <?php echo $this->context->renderPartial('controls'); ?>
        <div class="image">
            <?php echo Yii::$app->base->getAuthorImageHtml($currentImageContainer); ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php echo Yii::$app->base->getLastImageActiveInputHtml($lastImageActive);


