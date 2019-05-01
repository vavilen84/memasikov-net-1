<?php
use app\components\Base;

?>
<h1 class="center">Сделать мем</h1>
<div class="mem-previews">
    <?php foreach (Yii::$app->base->getBaseImages() as $baseImageContainer): ?>
        <div class="mem-item">
            <h2><?php echo $baseImageContainer->description; ?></h2>
            <a href="/mem/create/<?php echo $baseImageContainer->id; ?>">
                <?php echo Yii::$app->base->getBaseImageHtml($baseImageContainer); ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>
