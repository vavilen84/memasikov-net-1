<?php
use app\components\Base;

?>
<div class="tags">
    <a class="tag btn btn-primary" href="/"><h2><?php echo Base::ALL_TAG; ?></h2></a>
    <?php foreach (Yii::$app->base->getTagsList() as $ru => $en): ?>
        <?php $activeClass = !empty($tag) && ($tag == $en) ? 'btn-success' : 'btn-primary'; ?>
        <a class="tag btn <?php echo $activeClass; ?>" href="/<?php echo $en; ?>">
            <h2>
                <?php echo $ru; ?>
            </h2>
        </a>
    <?php endforeach; ?>
</div>