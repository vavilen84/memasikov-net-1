<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container content-container">
    <h2><?php echo $this->context->pageTitle; ?></h2>
    <?php echo $content; ?>
</div>
<?php $this->endContent(); ?>
