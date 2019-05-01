<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>
<script src="/js/addImage.js?v=<?php echo time(); ?>"></script>

<?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
    <div class="flash-<?php echo $key; ?>"><?php echo $message; ?></div>
<?php endforeach; ?>

<?php $form = ActiveForm::begin(['action' => 'admin/add-image-url']); ?>
<?php echo $form->field($addImageUrlForm, 'url')->textInput(['class' => 'w700']); ?>
<div class="tags">
    <?php foreach(Yii::$app->base->getTagsList() as $tag): ?>
        <button class="tag btn btn-primary"><?php echo $tag; ?></button>
    <?php endforeach;?>
</div>
<?php echo $form->field($addImageUrlForm, 'tags')->textInput(['class' => 'w350']); ?>
<div class="form-group">
    <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
